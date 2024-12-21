<script setup>

import { ref, watch, onMounted } from "vue";
import axios from "axios";
import { debounce } from "lodash";

const props = defineProps({
    dayId: {
        type: Number,
        required: true
    },
    selected: {
        type: Array,
        required: true
    }
});

onMounted(() => {
    chosenProducts.value = props.selected.map(id => ({ id }));
});

const highlightedIndex = ref(0);

const highlightNext = () => {
    if (highlightedIndex.value < suggestions.value.length - 1) {
        highlightedIndex.value++;
    } else {
        highlightedIndex.value = 0;
    }
};

const highlightPrevious = () => {
    if (highlightedIndex.value > 0) {
        highlightedIndex.value--;
    } else {
        highlightedIndex.value = suggestions.value.length - 1;
    }
};

const query = ref("");
const suggestions = ref([]);
const chosenProducts = ref([]);

const createNewIngredient = async (query) => {
    if (highlightedIndex.value !== -1) {
        choseProduct(suggestions.value[highlightedIndex.value]);
        return;
    }

    axios.post(`/api/v1/ingredients/store-new-ingredient`, { query: query })
        .then(response => {
            const data = response.data;

            chosenProducts.value.push(data.ingredient);
            query.value = "";
        })
        .catch(error => {
            console.error("Error saving ingredients:", error);
        });
};

const loadInitSuggestions = async () => {
    highlightedIndex.value = -1;

    try {
        const response = await axios.get(`/api/v1/ingredients/suggestions?selected=${chosenProducts.value.map(product => product.id).join(",")}`);
        suggestions.value = response.data;
    } catch (error) {
        console.error("Error fetching initial suggestions:", error);
    }
};

const fetchSuggestions = debounce(async (newQuery) => {
    highlightedIndex.value = -1;

    if (newQuery) {
        try {
            const response = await axios.get(`/api/v1/ingredients/suggestions?q=${newQuery}&selected=${chosenProducts.value.map(product => product.id).join(",")}`);
            suggestions.value = response.data;
        } catch (error) {
            console.error("Error fetching suggestions:", error);
        }
    } else {
        suggestions.value = [];
    }
}, 300);

watch(query, (newQuery) => {
    fetchSuggestions(newQuery);
});

const choseProduct = (product) => {
    highlightedIndex.value = -1;
    query.value = "";

    const index = suggestions.value.findIndex(suggestion => suggestion.id === product.id);
    if (index !== -1) {
        suggestions.value.splice(index, 1);
    }

    chosenProducts.value.push(product);
};

const save = () => {
    const chosenProductIds = chosenProducts.value.map(product => product.id);

    axios.post(`/api/v1/ingredients/${props.dayId}/save-ingredients`, { ingredients: chosenProductIds })
        .then(response => {
            window.location.reload();
        })
        .catch(error => {
            console.error("Error saving ingredients:", error);
        });
};
</script>

<style>
.highlighted {
    background-color: #f0f0f0;
}
</style>

<template>
    <div>
        <input type="text" v-model="query" @focus="loadInitSuggestions" @keyup.enter="createNewIngredient(query)" @keydown.up.prevent="highlightPrevious" @keydown.down.prevent="highlightNext" placeholder="Type to search..." />

        <ul v-if="suggestions.length">
            <li v-for="(suggestion, index) in suggestions" :key="suggestion.id" :class="{ 'highlighted': index === highlightedIndex }" class="border border-black" @click="choseProduct(suggestion)">
                {{ suggestion.name }}
            </li>
        </ul>

        <div id="chosen-products" class="mt-5 border border-black">
            <h2>Wybrane</h2>
            <hr>
            <ul>
                <li v-for="product in chosenProducts" :key="product.id">{{ product.name }}</li>
            </ul>
        </div>

        <button id="save" class="mt-5" @click="save()">
            Save
        </button>
    </div>
</template>

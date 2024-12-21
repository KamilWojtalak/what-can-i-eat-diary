import './bootstrap';

import { createApp } from 'vue'
import Counter from './components/Counter.vue'
import DayIngredients from './components/DayIngredients.vue';

const app = createApp()

app.component('counter', Counter)
app.component('day-ingredients', DayIngredients)

app.mount('#vue-app')

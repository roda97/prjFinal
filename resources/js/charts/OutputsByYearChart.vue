<template>
<div>
    <chart :chart-data="datacollection"></chart>
</div>
</template>

<script>
import Chart from "./LineChart.js";

export default {
    components: {
        Chart
    },
    data() {
        return {
            datacollection: null,
            statistics: {}
        };
    },

    computed: {
        
    },

    mounted() {

    },
    methods: {

        getStatistics() {
            axios.get('api/statistics/')
                .then(response => {
                    this.statistics = response.data.statistics;
                    console.log('stats: ' + JSON.stringify(this.statistics.conferences));

                    this.fillData();

                });
        },

        generateYears() {

            var array_years = [];
            for (var i = this.statistics.lowest_year; i <= this.statistics.highest_year; i++) {
                array_years.push(i);
            }

            return array_years;
        },

        generateValues(type) {
            var all_years = this.generateYears();
            var amount_per_year = [];
            for (var i = this.statistics.lowest_year; i <= this.statistics.highest_year; i++) {

                if (this.statistics[type][i] !== undefined) {
                    amount_per_year.push(this.statistics[type][i]);
                } else {
                    amount_per_year.push(0);
                }
            }

            return amount_per_year;

        },

        fillData() {

            this.datacollection = {
                labels: this.generateYears(),
                datasets: [{
                        label: "Books",

                        borderColor: 'red',
                        //pointBackgroundColor: 'red',
                        //pointBorderColor: 'red',
                        borderWidth: 2,
                        //backgroundColor: 'blue',

                        data: this.generateValues('books')
                    },
                    {
                        label: "Articles",

                        borderColor: 'blue',
                        //pointBackgroundColor: 'red',
                        //pointBorderColor: 'red',
                        borderWidth: 2,
                        //backgroundColor: 'blue',

                        data: this.generateValues('articles')
                    },
                    {
                        label: "Conferences",

                        borderColor: 'yellow',
                        //pointBackgroundColor: 'red',
                        //pointBorderColor: 'red',
                        borderWidth: 2,
                        //backgroundColor: 'blue',

                        data: this.generateValues('conferences')
                    },
                    {
                        label: "Others",

                        borderColor: 'green',
                        //pointBackgroundColor: 'red',
                        //pointBorderColor: 'red',
                        borderWidth: 2,
                        //backgroundColor: 'blue',

                        data: this.generateValues('others')
                    },

                ]
            };
        },
    },
    beforeCreate() {},

    created() {
        this.getStatistics();
    },
};
</script>

<style>
    </style>

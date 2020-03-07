<template>
<div class="card">
    <div class="card-body">
        <h2 class="card-title">Number of Outputs By Type</h2>
    </div>

    <div class="card-img-bottom">
        <chartjs-doughnut :bind="true" :datasets="datasets" :labels="labels" :option="option" />
    </div>
</div>
</template>

<script>
export default {
    methods: {

    },

    data() {
        return {
            statitics: null,
            datasets: [],
            labels: ["Books", "Articles", "Conferences", "Others"],
            option: {}
        };
    },

    mounted() {
        axios.get('api/statistics/countOutputsByType')
            .then(response => {
                this.statitics = response.data;
                this.datasets.push({
                    data: [
                        this.statitics.number_of_books,
                        this.statitics.number_of_articles,
                        this.statitics.number_of_conferences,
                        this.statitics.number_of_others],
                    backgroundColor: ["#f36e60", "#ffdb3b", "#185190", '#48a90a'],
                    hoverBackgroundColor: ["#fbd2cd", "#fef5c9", "#d1e3f7", '#55ff55']
                })

            });
    },

};
</script>

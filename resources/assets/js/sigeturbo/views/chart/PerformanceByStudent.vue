<template>
    <section>
        <canvas id="myChart" width="250" height="250"></canvas>
    </section>
</template>

<script>

    import Chart from 'chart.js';

    export default {

        props: [],
        components: {},
        data: function () {
            return {}
        },
        methods: {},
        mounted() {

            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        labels: ['1', '2', '3', '4'],
                        data: [12, 19, 3, 5],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ]
                    }]
                },
                options: {}
            });

        }

    }

</script>

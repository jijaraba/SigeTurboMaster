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
                    labels: ['DP', 'DB', 'DA', 'DS'],
                    datasets: [{
                        data: [12, 19, 3, 5],
                        backgroundColor: [
                            'rgba(237, 85, 101, 1)',
                            'rgba(252, 110, 81, 1)',
                            'rgba(47, 157, 163, 1)',
                            'rgba(160, 212, 104, 1)'
                        ]
                    }]
                },
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });

        }

    }

</script>

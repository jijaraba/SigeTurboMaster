<template>
    <section>
        <canvas id="myChart" width="250" height="250"></canvas>
    </section>
</template>

<script>

    import Chart from 'chart.js';
    import Monitorings from "../../models/Monitorings";

    export default {

        props: [
            'year',
            'period',
            'group',
            'student',
        ],
        components: {},
        data: function () {
            return {}
        },
        methods: {},
        mounted() {

            let stats = {
                labels: [],
                datasets: [{
                    data: [],
                    backgroundColor: [
                        'rgba(237, 85, 101, 1)',
                        'rgba(252, 110, 81, 1)',
                        'rgba(47, 157, 163, 1)',
                        'rgba(160, 212, 104, 1)'
                    ]
                }]
            };


            Monitorings.getMonitoringsForParents({
                year: this.year,
                period: this.period,
                group: this.group,
                user: this.student
            })
                .then(({stats}) => {
                    if (stats.length > 0) {
                        //Assign Values
                        stats.forEach(function (stat) {
                            stats.labels.push(stat.label);
                            stats.datasets[0].data.push(stat.value);
                        });
                    }
                })
                .catch(error => console.log(error));

            var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: stats,
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }


            });

        }

    }

</script>

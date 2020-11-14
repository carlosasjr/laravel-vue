import { Line } from 'vue-chartjs'

export default {
    props: {
      labels: {
          required: true,
          type: Array
      },

      datasets: {
          required: true,
          type: Array
      }
    },

    extends: Line,


    mounted () {
        this.render()
    },


    methods: {
        render () {
            this.renderChart({
                labels: this.labels,
                datasets: this.datasets
            }, {responsive: true, maintainAspectRatio: false})
        }
    },

    watch: {
        labels () {
            this.render()
        }
    }


}

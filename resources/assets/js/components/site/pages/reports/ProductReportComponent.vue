<template>
    <div>
        <div>Relatório de produtos</div>

        <hr>

        <select class="form-control" v-model="year" @change="loadChart">
            <option v-for="i in years" :key="i" :value="i">{{ i }}</option>
        </select>

        <chart-line
            :labels="labels"
            :datasets="datasets"
        ></chart-line>
    </div>
</template>

<script>
import ChartLine from "./charts/ChartLine";

export default {
    mounted () {
      this.loadChart()
    },


    data() {
        return {
            year: new Date().getFullYear(),
            labels: [],
            datasets: [
                {
                    label: 'Relatório de mês',
                    backgroundColor: '#f87979',
                    data: []

                }
            ]
        }
    },

    computed: {
      years () {
          let year = new Date().getFullYear()
          let startYear = year - 10
          let years = []

          for (let i = year; i >= startYear; i--) {
              years.push(i)
          }

          return years
      }
    },

    methods: {
      loadChart() {
          this.$store.dispatch('productsCreateMonth', this.year)
              .then(response => {
                  this.labels = response.labels
                  this.datasets[0].data = response.datasets
              })
              .catch(error => {
                  this.$snotify.error('Falha ao carregar gráfico')
              })
      }
    },


    components: {
        ChartLine
    }
}
</script>

<style scoped>

</style>

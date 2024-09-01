<template>
<label for="destination" class="form_label_where_from">
                        <span>Откуда</span>
                        <input v-model="destination" type="text"  placeholder="Выберите место">
                        <select name="" id="destination">
                            <option v-for="city in destinationSearch()" :value="city.name">{{ city.name }}</option>
                        </select>
                    </label>
                    <label for="where" class="form_label_where">
                        <span>Куда</span>
                        <input v-model="where" type="text"  placeholder="Выберите место">
                        <select name="" id="where">
                            <option v-for="city in whereSearch()" :value="city.name">{{ city.name }}</option>
                        </select>
                    </label>

</template>

<script>
export default{
    props:['allCity'],
    data(){
        return{
            destination:'',
            where:'',
        }
    },
    methods:{
        destinationSearch(){
            return this.allCity.filter(row => {
            return Object.values(row).some(value => {
              return String(value).toLowerCase().includes(this.destination.toLowerCase());
            });
          });
        },
        whereSearch(){
            return this.allCity.filter(row => {
            return Object.values(row).some(value => {
              return String(value).toLowerCase().includes(this.where.toLowerCase());
            });
          });
        }
    },
    mounted(){

    }
}
</script>
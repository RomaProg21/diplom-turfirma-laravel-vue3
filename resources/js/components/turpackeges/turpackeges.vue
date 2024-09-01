<template>
    
  <section class="blog_search">
        <div class="found_tours" >
            <div class="found_tour" v-for="(tur,idx) in dinamicCityFilter()" :key="idx">
                <div class="main_information_tour">
                    <img class="photos_tour" :src="`${tur.tur.photo}`" alt="photos">
                    <div class="information_tour">
                        <h1>{{ tur.tur.name }}</h1>
                        <h1>{{ tur.country.name }}, {{tur.city.name}}</h1>
                        <div class="parametrs">
                            <span><img src="../../../../public/photos/mdi_date_2.svg" alt="photos"></span>
                            <h3>Дата: {{ tur.tur.date_start }}</h3>
                        </div>
                        <div class="parametrs">
                            <img src="../../../../public/photos/mdi_duration_2.svg" alt="photos">
                            <h3>Время провождения: {{ tur.tur.duration }} ночей</h3>
                        </div>
                        <div class="parametrs">
                            <img src="../../../../public/photos/mdi_people_2.svg" alt="photos">
                            <h3>Количество человек: до {{ tur.tur.num_people }}</h3>
                        </div>
                        <div class="parametrs">
                            <img src="../../../../public/photos/mdi_hotel_2.svg" alt="photos">
                            <h3>Отель: {{ tur.hotel.name }}</h3>
                        </div>
                    </div>
                </div>
                <div class="action_tour">
                    <div v-if="tur.favorite!='not auth'">
                    <img @click="favoriteTur(tur)" v-show="tur.favorite.length==0" :class="String(tur.tur.id)" src="../../../../public/photos/mdi_cards_heart.svg" alt="photos">
                    <img @click="favoriteTurDelete(tur)" v-show="tur.favorite.length>0" :class="String(tur.tur.id)" src="../../../../public/photos/mdi_cards_heart_red.svg" alt="photos">
                     </div>
                    <h3>от {{ tur.tur.price }}₽</h3>
                    <form action="/tour" method="GET">
                    <slot></slot>
                    <input type="hidden" :value="tur.tur.id" name="turId">
                    <input type="hidden" :value="numPeople" name="numPeople">
                    <button class="look_tour">Посмотреть тур</button>
                    </form>
                </div>
            </div>

            <div class="gorizont_line_tour"></div>
        </div>

        <div class="filters_tour">
            <div class="vert_line_left"></div>
            <div class="container">
                <div>
                    <div class="gorizont_line"></div>
                    <div class="title_filters">
                        <h1>Фильтры</h1>
                        <div class="close_filters" @click="resetFilter">
                            <h3>Сбросить</h3>
                            <img src="../../../../public/photos/close_filters.svg" alt="photos">
                         </div>
                    </div>
                </div>
                <!-- <div>
                    <div class="gorizont_line"></div>
                    <div class="filters_menu">
                        <h1>Откуда</h1>
                        <div class="cell">
                            <label for="where_from" class="cell-label">Напишите город отправления</label>
                            <div class="cell-value">
                                <input v-model="whereFrom" type="text" class="personal_info_input" id="where_from" placeholder="Город">
                                <span><img src="../../../../public/photos/pencil_filters.svg" alt="photos"></span>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div>
                    <div class="gorizont_line"></div>
                    <div class="filters_menu">
                        <h1>Куда</h1>
                        <div class="cell">
                            <label for="where" class="cell-label">Напишите город назначения</label>
                            <div class="cell-value">
                                <input v-model="where" type="text" class="personal_info_input" id="where" placeholder="Город">
                                <span><img src="../../../../public/photos/pencil_filters.svg" alt="photos"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="gorizont_line"></div>
                    <div class="filters_menu">
                        <h1>Цена</h1>
                        <div class="prices_inputs">
                            <div class="cell">
                                <label for="price_from" class="cell-label">Цена от</label>
                                <div class="cell-value">
                                    <input v-model="priceStart" type="text" class="personal_info_input filters_price" id="price_from" placeholder="От">
                                    <span><img src="../../../../public/photos/pencil_filters.svg" alt="photos"></span>
                                </div>
                            </div>
                            <div class="cell">
                                <label for="price_up" class="cell-label">Цена до</label>
                                <div class="cell-value">
                                    <input v-model="priceEnd" type="text" class="personal_info_input filters_price" id="price_up" placeholder="До">
                                    <span><img src="../../../../public/photos/pencil_filters.svg" alt="photos"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="gorizont_line"></div>
                    <div class="filters_menu">
                        <h1>Количество человек</h1>
                            <div class="cell">
                            <label for="guests" class="cell-label">Выберите количество человек</label>
                            <div class="cell-value">
                                <select v-model="numPeople" id="guests" class="personal_info_select">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="gorizont_line"></div>
                    <div class="filters_menu">
                        <h1>Продолжительность</h1>
                        <div class="cell">
                            <label for="duration" class="cell-label">Выберите продолжительность тура</label>
                            <div class="cell-value">
                                <select v-model="duration" id="duration" class="personal_info_select">
                                    <option value="7">7 ночей</option>
                                    <option value="14">14 ночей</option>
                                    <option value="21">21 ночь</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="gorizont_line"></div>
                   <!-- <div class="filters_menu">
                        <h1>Дата приезда</h1>
                        <div class="cell">
                            <label for="departure-date" class="cell-label">Наберите дату приезда</label>
                            <div class="cell-value">
                                <input v-model="dateArrive" type="text" class="personal_info_input" id="departure-date">
                                <span><img src="../../../../public/photos/pencil_filters.svg" alt="photos"></span>
                            </div>
                        </div>
                    </div>
                    <div class="gorizont_line"></div> -->
                </div>
                <button @click="filterTurs" class="enter_filters">Применить фильтры</button>
            </div>
            <div class="vert_line_left"></div>
        </div>
    </section>
</template>

<script>
export default{
    props:['turs'],
    data(){
        return {
            whereFrom:'',
            where:'',
            priceStart:'',
            priceEnd:'',
            numPeople:'1',
            duration:'7',
            // dateArrive:'',
            turs2:[],
        }
    },
    methods:{
        favoriteTur(tur){
        axios.post('/favoriteTurAdd',{tur:tur.tur.id}).then(response=>{
        document.getElementsByClassName(String(tur.tur.id))[0].style.display = "none";
        document.getElementsByClassName(String(tur.tur.id))[1].style.display = "block";
        });
  
        },
        favoriteTurDelete(tur){
        axios.post('/favoriteTurDel',{tur:tur.tur.id}).then(response=>{
        document.getElementsByClassName(String(tur.tur.id))[1].style.display = "none";
        document.getElementsByClassName(String(tur.tur.id))[0].style.display = "block";
        });
    },
    checkLocalStorage(){
        localStorage.getItem("num_people") != null ? this.numPeople = localStorage.getItem("num_people") : this.numPeople = '1';
        localStorage.getItem("date") != null ? this.dateArrive = localStorage.getItem("date") : this.dateArrive = '';
        localStorage.getItem("duration") != null ? this.duration = localStorage.getItem("duration") : this.duration = '7';
        localStorage.getItem("destination") != null ? this.whereFrom = localStorage.getItem("destination") : this.whereFrom = '';
        localStorage.getItem("where") != null ? this.where = localStorage.getItem("where") : this.where = '';
        localStorage.clear();
    },
    dinamicCityFilter(){
          return this.turs2.filter(row => {
            return Object.values(row.city).some(value => {
              return String(value).toLowerCase().includes(this.where.toLowerCase());
            });
          });
    },
    filterTurs(){
        if(this.duration!='' && this.numPeople!=''){
        axios.post('/filterTurs',{
            numPeople:this.numPeople,
            duration:this.duration,
            // where:this.where,
            priceStart:this.priceStart,
            priceEnd:this.priceEnd,
        }).then(response=>{
            this.turs2 = response.data.turs;
        });  
        } else {
            alert('Поле количества людей или продолжительности не заполнено.')
        }
    },
    resetFilter(){
        axios.post('/getAllTurs').then(response=>{
            this.turs2 = response.data.turs;    
        });
        this.duration = '7';
        this.priceStart = '';
        this.priceEnd = '';
        this.numPeople = '1';
        this.where = '';
    }
},
    mounted(){
        this.turs2 = this.turs;
        this.checkLocalStorage();
    }
}
</script>
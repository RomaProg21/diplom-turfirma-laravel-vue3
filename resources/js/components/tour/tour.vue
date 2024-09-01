<template>
<div class="settings_tour">
            <div class="tour_main_information">
                <img class="photos_tour" style="margin-right:10px" :src="tour.photo" alt="photos">
                <div class="tour_information">
                    <h1 class="name_tour">{{ tour.name }}</h1>
                    <div style="display:flex;" class="country-city">
                        <h2>{{country.name}},</h2>
                        <h2>{{city.name}}</h2>
                    </div>
                    <div class="parametrs">
                        <span><img :src="'photos/mdi_date_2.svg'" alt="photos"></span>
                        <h3>Дата приезда: {{ tour.date_start }}</h3>
                    </div>
                    <div class="parametrs">
                        <img :src="'photos/mdi_duration_2.svg'" alt="photos">
                        <h3>Время провождения: {{ tour.duration }} ночей</h3>
                    </div>
                    <div class="parametrs">
                        <img :src="'photos/mdi_people_2.svg'" alt="photos">
                        <h3>Количество человек: до {{ tour.num_people }}</h3>
                    </div>
                </div>
            </div>
            <p class="description_tour">
                {{tour.descr}}
            </p>
            <div class="hotel_title">
                <h1>Отель</h1>
            </div>
            <div class="hotel">
                <img :src="hotel.photo" alt="photos" class="hotel_photo">
                <div class="hotel_information">
                    <h1>{{hotel.name}}</h1>
                    <p class="description_tour description_hotel">
                        {{ hotel.descr }}
                    </p>
                </div>
            </div>
            <form>
                <div class="room" v-for="(room,idx) in rooms" :key="idx">
                    <img width="250px" height="150px"  :src="room.photo" alt="photos">
                    <div class="info">
                        <p class="class">{{room.class}}</p>
                        <p class="price">{{ room.price }}</p>
                    </div>
                    <p class="description">{{room.descr}}</p>
                    <input type="radio" @click="changeRoom(room)" v-model="selectRoom" id="room1" name="room" :value="room.id">
                    <label for="room1"></label>
                </div>
            
            </form>
            <div class="hotel_title">
                <h1>Рейс</h1>
            </div>
            <form>
                <div class="transport">
                    <div>
                        <p class="class">{{transport.name}}</p>
                        <p>{{ transportDate }}</p>
                    </div>
                    <p class="price">{{ transport.price }}</p>
                    <p class="description">Туда и обратно</p>
                </div>
            </form>
            <div class="hotel_title">
                <h1>Услуги</h1>
            </div>
       
            <form>
                <div class="services" v-for="(dopService,idx) in dopServices" :key="idx">
                    <p style="min-width:550px" class="class">{{ dopService.name }}</p>
                    <p class="price">{{ dopService.price }}</p>
                    <p class="description">{{ dopService.descr }}</p>
                    <input type="checkbox" @click="Service(dopService)" name="room" checked>
                    <label for="room1"></label>
                </div>
            </form>
        </div>
        <div class="small_information">
            <div class="total_summ">
                <div class="total_summ_h1">
                    <h1>Итоговая сумма</h1>
                    <h1>{{ summ }}</h1>
                </div>
            </div>
            <div class="detail_prise">
                <div class="detail_prise_title">
                    <h2>Детали стоимости</h2>
                </div>
                <div class="putckts_price">
                    <h1>Стоимость отеля</h1>
                    <h1>{{correntPriceRoom}}₽</h1>
                </div>
                <div class="gorizont_line"></div>
                <div class="putckts_price">
                    <h1>Стоимость рейса</h1>
                    <h1>{{transport.price}}₽</h1>
                </div>
                <div class="gorizont_line"></div>
                <div class="putckts_price">
                    <h1>Стоиомсть дополнительных услуг</h1>
                    <h1>{{sumServices}}₽</h1>
                </div>
            </div>
            <button :disabled="authCheck==false" @click="reservation" class="bronb">Забронировать</button>    
        </div>

</template>


<script>
export default{
    props:['tour','city',
    'country','hotel',
    'rooms','dopServices',
    'transport','numPeople',
    'authCheck'
],
    data(){
        return{
            services:[],
            summ:0,
            selectRoom:null,
            roomPrice:0,
            correntPriceRoom:0,
            transportDate:null,
            sumServices:0,
            userAuth:null,
        }
    },
    methods:{
        Service(service){
            this.services.indexOf(service.id)!=-1 ?
            (this.services = this.services.filter(el=>el!=service.id),this.summ-=Number(service.price),this.sumServices-=Number(service.price)) :
            (this.services.push(service.id),this.summ+=Number(service.price),this.sumServices+=Number(service.price))
        },
        changeRoom(room){
            this.correntPriceRoom = Number(room.price);
            this.summ-= this.roomPrice;
            this.summ+= Number(room.price);
            this.roomPrice = Number(room.price)
        },
        reservation(){
            if(this.userAuth.date_issue_pasport!=null &&
               this.userAuth.series_number_pasport!=null &&
               this.userAuth.kod_department!=null &&
               this.userAuth.who_issued_pasport!=null &&

               this.userAuth.international_date!=null &&
               this.userAuth.international_end!=null &&
               this.userAuth.international_series_number!=null &&
               this.userAuth.who_issued_international!=null

            ){
            axios.post('/reservation',{
                tour:this.tour.id,
                sum:this.summ,
                date:this.transportDate,
                duration:this.tour.duration,
                numPeople:this.numPeople,
                services:this.services.join(','),
            }).then(response=>{
                window.location.href = '/wait';
            })
        } else {
            alert('Необходимо заполнить данные о паспорте и загранпаспорте в профиле.')
        }
        }
    },
    mounted(){
    if(this.authCheck){
        axios.post('/getUser').then(response=>{
            this.userAuth = response.data.user;
        })
    }
     this.summ+=this.tour.price;
     let standartRoom = this.rooms.filter(el=>el.class=="Standart")[0];
     this.selectRoom = standartRoom.id;
     this.correntPriceRoom = Number(standartRoom.price);
     this.roomPrice = Number(standartRoom.price);
     this.dopServices.map(el=>(this.services.push(el.id),this.sumServices+=Number(el.price)));
     this.transportDate = new Date(new Date(this.tour.date_start).getTime() - (24*60*60*1000)).toISOString().split('T')[0];
    }
}
</script>

<style scoped>
.photos_tour{
    border-radius: 25px;
    height: 330px;
    width: 267px;
}
button:disabled,
button[disabled]{
  border: 1px solid #999999;
  background-color: #cccccc;
  color: #666666;
}

</style>
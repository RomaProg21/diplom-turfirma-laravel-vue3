<template>
<section class="profile_data">
        <div class="profile_settings">
            <div class="vert_line_left"></div>
            <div>
                <div class="profile_avatar_fon">
                    <span>
                        <img :src="user.photo" style="border-radius:50px" width="300px" height="300px" alt="photos">
                    </span>
                </div>
                <div class="profile_name">
                    <h1>{{ user.surname }} {{ user.name }}</h1>
                    <h3>Профиль подтвержден</h3>
                </div>
                <div class="profile_settings_buttons">
                    <button @click="formActive=!formActive" class="button_change_photo">Сменить фотографию</button>
                    <div v-if="formActive" style="border:1px solid orange;border-radius:10px;margin:10px;padding:5px;">
                    <form action="/changePhotoUser" method="POST" enctype="multipart/form-data">
                        <slot></slot>
                        <input class="" type="file" name="image"> 
                        <button style="margin-top:10px" class="button_change_photo">Изменить</button>  
                    </form>
                    </div>
                    <form action="/delPhoto" method="POST">
                        <slot></slot>
                    <button type="submit" class="button_delete_photo">Удалить фотографию</button>
                     </form>
                    <form action="/logout" method="POST">
                        <slot></slot>
                    <button type="submit" class="button_exit">Выход</button>
                    </form>
                </div>
            </div>
            <div class="vert_line_left"></div>
        </div>
        <div class="user_data">
            <div class="vert_line_left"></div>
            <div class="container">
                <div class="block">
                    <div class="block-header">Личная информация</div>
                    <div class="block-content personal_info closed">
                        <div class="cell">
                            <label for="lastname" class="cell-label">Фамилия</label>
                            <div class="cell-value">
                                <input type="text" v-model="surnameUser" class="personal_info_input" id="lastname" placeholder="Фамилия">
                                <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                            </div>
                        </div>
                        <div class="cell">
                            <label for="firstname" class="cell-label">Имя</label>
                            <div class="cell-value">
                                <input type="text" v-model="nameUser" class="personal_info_input" id="firstname" value="Павел" placeholder="Имя">
                                <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                            </div>
                        </div>
                        <div class="cell">
                            <label for="fullname" class="cell-label">Отчество</label>
                            <div class="cell-value">
                                <input type="text" v-model="patronomicUser" class="personal_info_input" id="fullname" value="Александрович" placeholder="Отчество">
                                <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                            </div>
                        </div>
                        <div class="cell">
                            <label for="date_of_birth" class="cell-label">Дата рождения</label>
                            <div class="cell-value">
                                <input type="text" v-model="birthdayUser" class="personal_info_input" id="date_of_birth" value="" placeholder="Дата рождения">
                                <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                            </div>
                        </div>
                        <div class="cell">
                            <label for="gender" class="cell-label">Пол</label>
                            <div class="cell-value">
                                <select v-model="genderUser" id="gender" class="personal_info_select">
                                    <option value="male">Мужской</option>
                                    <option value="female">Женский</option>
                                </select>
                            </div>
                        </div>
                        <div class="cell">
                            <label style="opacity: 0;" class="cell-label" for=""></label>
                            <div style="display: flex;justify-content: center;" class="cell-value">
                                <button @click="changePersonalInfo" class="button_change_photo">Сохранить</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block">
                    <div class="block-header">Документы</div>
                    <div class="block-content documenst closed">
                        <div class="add-passport">
                            <img :src="'photos/plus.svg'" alt="photos">
                            <button>Добавить паспорт</button>
                        </div>
                        <div class="passport-form hidden">
                            <div class="delete-passport-form">
                                <h1>Паспорт</h1>
                                <h2 class="delete-passport" @click="delPasport">Удалить</h2>
                            </div>
                            <div class="passport-info">
                                <div class="cell">
                                    <label for="passport_number" class="cell-label">Серия и номер паспорта</label>
                                    <div class="cell-value">
                                        <input v-model="pasportUser" type="text" class="personal_info_input" id="passport_number" placeholder="Серия и номер">
                                        <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                    </div>
                                </div>
                                <div class="cell">
                                    <label for="passport_date" class="cell-label">Дата выдачи паспорта</label>
                                    <div class="cell-value">
                                        <input type="text" v-model="datePasportUser" class="personal_info_input" id="passport_date" placeholder="Дата выдачи">
                                        <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                    </div>
                                </div>
                                <div class="cell">
                                    <label for="passport_kod" class="cell-label">Код подразделения</label>
                                    <div class="cell-value">
                                        <input v-model="kodDepartment" type="text" class="personal_info_input" id="passport_kod" placeholder="Код подразделения">
                                        <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                    </div>
                                </div>
                                <div class="cell target-item">
                                    <label for="passport_where_get" class="cell-label">Кем выдан</label>
                                    <div class="cell-value">
                                        <input v-model="whoPasport" type="text" class="personal_info_input where_get" id="passport_where_get" placeholder="Кем выдан">
                                        <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                    </div>
                                </div>
                                <div class="cell target-item">
                            <label style="opacity: 0;" class="cell-label" for=""></label>
                            <div style="display: flex;justify-content: flex-end;" class="cell-value">
                                <button @click="changePasport" class="button_change_photo">Сохранить</button>
                            </div>
                        </div>  
                            </div>
                        </div>
                        <div class="add-international-passport">
                            <img :src="'photos/plus.svg'" alt="photos">
                            <button>Добавить загранпаспорт</button>
                        </div>
                        <div class="international-passport-form hidden">
                            <div class="delete-international-passport-form">
                                <h1>Загранпаспорт</h1>
                                <h2 class="delete-international-passport" @click="delInternational">Удалить</h2>
                            </div>
                            <div class="passport-info">
                            <div class="cell">
                                <label for="international_passport_number" class="cell-label">Серия и номер загранпаспорта</label>
                                <div class="cell-value">
                                    <input v-model="internationalPasport" type="text" class="personal_info_input" id="international_passport_number" placeholder="Серия и номер">
                                    <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                </div>
                            </div>
                            <div class="cell">
                                <label for="international_passport_date" class="cell-label">Дата выдачи загранпаспорта</label>
                                <div class="cell-value">
                                    <input v-model="internationalDate" type="text" class="personal_info_input" id="international_passport_date" placeholder="Дата выдачи">
                                    <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                </div>
                            </div>
                            <div class="cell">
                                <label for="international_passport_enddate" class="cell-label">Срок действия</label>
                                <div class="cell-value">
                                    <input v-model="internationalEnd" readonly type="text" class="personal_info_input" id="international_passport_enddate" placeholder="Срок действия">
                                    <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                </div>
                            </div>
                            <div class="cell target-item">
                                <label for="international_passport_where_get" class="cell-label">Кем выдан</label>
                                <div class="cell-value">
                                    <input v-model="internationalWho" type="text" class="personal_info_input where_get" id="international_passport_where_get" placeholder="Кем выдан">
                                    <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                </div>
                            </div>
                            <div class="cell target-item">
                            <label style="opacity: 0;" class="cell-label" for=""></label>
                            <div style="display: flex;justify-content: flex-end;" class="cell-value">
                                <button @click="changeIntertnational" class="button_change_photo">Сохранить</button>
                            </div>
                        </div> 
                            </div>
                        </div>
                    </div>
                </div>
               

                <div class="block">
                    <div class="block-header">Мои поездки</div>
                    <div class="block-content my_passwords closed" style="padding:10px 20px">
                        <div >
                            <div >
                                <div class="cell">
    <table width="100%">
  <caption>
    История бронирования
  </caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Тур</th>
      <th scope="col">Статус</th>
      <th scope="col">Сумма</th>
      <th scope="col">Дата</th>
      <th scope="col">Продолжительность</th>
      <th scope="col">Количество человек</th>
      <th scope="col">Доп услуги</th>
      <th scope="col">Договор</th>


    </tr>
  </thead>
  <tbody>
   
    <tr class="data-reservation" v-for="(reservat,idx) in reservation" :key="idx" @click="openTur(reservat.tur.id,reservat.reservation.num_people)">
       
   
      <th scope="row">{{ idx+1 }}</th>
    
      <th>{{ reservat.tur.name }}</th>
      <slot></slot>
      <input type="hidden" :value="reservat.tur.id" name="turId">
      <input type="hidden" :value="reservat.reservation.num_people" name="numPeople">

      <td style="white-space: nowrap">{{ reservat.status.name }}</td>
      <td>{{ reservat.reservation.summ }}</td>
      <td style="white-space: nowrap">{{ reservat.reservation.date_start }}</td>
      <td>{{ reservat.reservation.duration }} ночей</td>
      <td>{{ reservat.reservation.num_people }}</td>
      <td><div v-for="service in reservat.services">{{ service.name }} <hr></div></td>
      <td><a href="#">Договор</a></td>

    </tr>
  </tbody>
  <!-- <tfoot>
    <tr>
      <th scope="row" colspan="2">Average age</th>
      <td>33</td>
    </tr>
  </tfoot> -->
</table>

                                </div>
                            </div>
                           
                          
                           
                        </div>
                      
                    </div>
                </div>

                <div class="block">
                    <div class="block-header">Избранное</div>
                    <div class="block-content my_passwords closed" style="padding:10px 20px">
                        <div >
                            <div >
                                <div class="cell">
    <table width="100%">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Название</th>
      <th scope="col">Цена</th>
      <th scope="col">Дата</th>
      <th scope="col">Продолжительность</th>
      <th scope="col">Количество человек</th>

    </tr>
  </thead>
  <tbody>
   
    <tr class="data-reservation" v-for="(favorite,idx) in favoriteAll" :key="idx" @click="openTur(favorite.id,favorite.num_people)">
       
   
      <th scope="row">{{ idx+1 }}</th>
    
      <th>{{ favorite.name }}</th>
      
      <td style="white-space: nowrap">от {{ favorite.price }}</td>
      <td>{{ favorite.date_start }}</td>
      <td style="white-space: nowrap">{{ favorite.duration }} ночей</td>
      <td>{{ favorite.num_people }} </td>
  
    </tr>
  </tbody>

</table>

                                </div>
                            </div>
                           
                          
                           
                        </div>
                      
                    </div>
                </div>

                <div class="block">
                    <div class="block-header">Пароль</div>
                    <div class="block-content my_passwords closed">
                        <div class="my_passwords_form">
                            <div class="edit_password">
                                <div class="cell">
                                    <label for="main_password" class="cell-label">Пароль</label>
                                    <div class="cell-value">
                                        <input v-model="passwordUser" type="password" class="personal_info_input" id="main_password" placeholder="Пароль">
                                        <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                    </div>
                                </div>
                                <p>Введите пароль, который установлен у вас сейчас.</p>    
                            </div>
                            <div class="edit_password">
                                <div class="cell">
                                    <label for="new_password" class="cell-label">Новый пароль</label>
                                    <div class="cell-value">
                                        <input type="password" v-model="newPasswordUser" class="personal_info_input" id="new_password" placeholder="Новый пароль">
                                        <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                    </div>
                                </div>
                                <p>Придумайте новый пароль, который состоит из цифр и букв английского алфавита.</p>    
                            </div>
                            <div class="edit_password last_password">
                                <div class="cell">
                                    <label for="again_new_password" class="cell-label">Повтор нового пароля</label>
                                    <div class="cell-value">
                                        <input type="password" v-model="newPasswordUser2" class="personal_info_input" id="again_new_password" placeholder="Подтверждение">
                                        <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                    </div>
                                </div>
                                <p>Повторите ваш новый пароль.</p>    
                            </div>
                            <div class="cell target-item">
                            <label style="opacity: 0;" class="cell-label" for=""></label>
                            <div style="display: flex;justify-content: flex-end;" class="cell-value">
                                <button @click="changePassword" class="button_change_photo">Сохранить</button>
                            </div>
                        </div> 
                        </div>
                      
                    </div>
                </div>
                <div class="block">
                    <div class="block-header">Мои номера</div>
                    <div class="block-content my_numbers closed">
                        <div class="my_numbers_form">
                            <div class="telephone_number">
                                <div class="cell">
                                    <label for="main_telephon"  class="cell-label">Основной номер телефона</label>
                                    <div class="cell-value">
                                        <input 
                                        v-model="userNumber"
                                        class="personal_info_input" 
                                        maxlength="16"
                                        id="main_telephon"
                                        placeholder="+7(___)___-__-__"
                                        type="tel" 
                                        >
                                        <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                    </div>
                                </div>
                                <p>С помощью этого номера телефона с вами может связаться наш менеджер. Также он может использоваться для авторизации и восстановления доступа в аккаунт.</p>    
                            </div>
                            <div class="telephone_number">
                                <div class="cell">
                                    <label for="other_telephon" class="cell-label">Дополнительный номер телефона</label>
                                    <div class="cell-value">
                                        <input v-model="userDopNumber" type="text" class="personal_info_input" id="other_telephon" placeholder="Номер">
                                        <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                    </div>
                                </div>
                                <p>Если вы утратили доступ к основному вашему номеру, то вам поможет запасной дополнительный номер.</p>
                            </div>
                        </div>
                        <div class="cell target-item">
                            <label style="opacity: 0;" class="cell-label" for=""></label>
                            <div style="display: flex;justify-content: flex-end;" class="cell-value">
                                <button @click="changeNumber" class="button_change_photo">Сохранить</button>
                            </div>
                        </div>  
                    </div>
                </div>
                <div class="block">
                    <div class="block-header">Почтовый ящик</div>
                    <div class="block-content my_email closed">
                        <div class="telephone_number">
                            <div class="cell target-email">
                                <label for="main_email" class="cell-label">Почтовый ящик</label>
                                <div class="cell-value">
                                    <input v-model="emailUser" type="text" class="personal_info_input target-email-input" id="main_email" placeholder="Email">
                                    <span><img :src="'photos/pencil.svg'" alt="photos"></span>
                                </div>
                            </div>
                            <p>Почтовый ящик необходим для входа в личный кабинет. Также на него будут приходить оповещения.</p>    
                        </div>
                        <div class="cell target-item">
                            <label style="opacity: 0;" class="cell-label" for=""></label>
                            <div style="display: flex;justify-content: flex-end;" class="cell-value">
                                <button @click="changeEmail" class="button_change_photo">Сохранить</button>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <div class="vert_line_left"></div>
        </div>
    </section>

</template>

<script>

export default{
    props:['user','reservation','csrf','favoriteAll'],
    data(){
        return{
            formActive:false,
            surnameUser:this.user.surname,
            nameUser:this.user.name,
            patronomicUser:this.user.patronomic,
            birthdayUser:this.user.birthday,
            genderUser:this.user.gender,
            pasportUser:this.user.series_number_pasport,
            datePasportUser:this.user.date_issue_pasport,
            kodDepartment:this.user.kod_department,
            whoPasport:this.user.who_issued_pasport,
            internationalPasport:this.user.international_series_number,
            internationalDate:this.user.international_date,
            internationalEnd:this.user.international_end,
            internationalWho:this.user.who_issued_international,
            passwordUser:'',
            newPasswordUser:'',
            newPasswordUser2:'',
            userNumber:this.user.number,
            userDopNumber:this.user.dop_number,
            emailUser:this.user.email,
        }
    },
    methods:{
        delPasport(){
            axios.post('/delPasport').then(response=>{
            });
        },
        delInternational(){
            axios.post('/delInternational').then(response=>{

            });

        },
        openTur(turid,numpeople){
            window.open(
            `/tour?_token=${this.csrf}&turId=${turid}&numPeople=${numpeople}`, '_blank');
        },
        changePersonalInfo(){
            axios.post('/changePersonalInfo',{
                surname:this.surnameUser,
                name:this.nameUser,
                patronomic:this.patronomicUser,
                birthday:this.birthdayUser,
                gender:this.genderUser
            }).then(response=>{
               location.reload();
            })
        },
        changePasport(){
            axios.post('/changePasport',{
                seriesAndNumber:this.pasportUser,
                datePasport:this.datePasportUser,
                kodDepartment:this.kodDepartment,
                pasportWho:this.whoPasport
            }).then(response=>{
                location.reload()
            });
        },
        changeIntertnational(){
            axios.post('/changeIntertnational',{
                internationalPasport:this.internationalPasport,
                internationalDate:this.internationalDate,
                internationalEnd:this.internationalEnd,
                internationalWho:this.internationalWho
            }).then(response=>{
                location.reload()
            });
        },
        changePassword(){
            if(this.newPasswordUser2==this.newPasswordUser2 && this.newPasswordUser.length>5 && this.passwordUser!=this.newPasswordUser){
            axios.post('/changePassword',{
                passwordUser:this.passwordUser,
                passwordNew:this.newPasswordUser
            }).then(response=>{
                if(response.data.status=='true'){
                    alert('Пароль успешно изменен.')
                } else {
                    alert('Неверный старый пароль.')
                }
            });
        } else {
            alert('Пароли не совпадают,новый пароль содержит меньше 6 символов или старый пароль совпадает с новым паролем.');
        }
        },
        changeNumber(){
            axios.post('/changeNumber',{
                number:this.userNumber,
                dopNumber:this.userDopNumber
            }).then(response=>{
                location.reload();
            });
        },
        changeEmail(){
            if(this.emailUser.includes('@')){
            axios.post('/changeEmail',{
                email:this.emailUser
            })

            .catch(error=>{
                alert('Данный email уже занят')
            })
            .then(response=>{
                location.reload();
            });
        }
    }
    },
    mounted(){
        this.internationalEnd = new Date(this.internationalDate).setFullYear(this.internationalDate.getFullYear() + 10);

         },
    

}
</script>

<style scoped>
table {
  border-collapse: collapse;
  border: 2px solid rgb(140 140 140);
  font-family: sans-serif;
  font-size: 0.8rem;
  letter-spacing: 1px;
}

caption {
  caption-side: bottom;
  padding: 10px;
  font-weight: bold;
}

thead,
tfoot {
  background-color: rgb(228 240 245);
}

th,
td {
  border: 1px solid rgb(160 160 160);
  padding: 8px 10px;
}

td:last-of-type {
  text-align: center;
}

tbody > tr:nth-of-type(even) {
  background-color: rgb(237 238 242);
}

tfoot th {
  text-align: right;
}
.data-reservation:hover {
  cursor:pointer;
  background-color: rgb(232, 234, 239);
}
</style>
<template>

<section class="registration">
        <div class="registration_component">
            <h1>Регистрация</h1>
            <h3>Заполните все, указанные ниже, поля</h3>
            <form action="/createUser" method="POST" enctype="multipart/form-data">
                <slot></slot>
            <div class="registration_forma">
                <div>
                    <input type="text" id="firstname" name="name" placeholder="Имя" v-model="name">
                    <span v-show="name.length<2" class="clue" data-clue="Имя не указано"><img src="../../../../public/photos/error_input.svg" alt="photos"></span>
                </div>
                <div>
                    <input type="text" id="lastname" name="surname" placeholder="Фамилия" v-model="surname">
                    <span v-show="surname.length<2" class="clue" data-clue="Фамилия не указана"><img src="../../../../public/photos/error_input.svg" alt="photos"></span>
                </div>
                <div>
                    <input type="email" id="main_email" name="email" placeholder="Почта" v-model="email">
                    <span v-show="email.length<2" class="clue" data-clue="Почта не указана"><img src="../../../../public/photos/error_input.svg" alt="photos"></span>
                </div>
                <div>
                    <input 
                    maxlength="17"
                    id="online_phone"
                    value="+7(___)___-__-__"
                    pattern="\+7\s?[\(]{0,1}9[0-9]{2}[\)]{0,1}\s?\d{3}[-]{0,1}\d{2}[-]{0,1}\d{2}"
                    placeholder="+7(___)___-__-__"
                    type="tel" 
                    name="number" 
                    v-model="phone">
                    <span v-show="phone.length<10" class="clue" data-clue="Телефон не указан"><img src="../../../../public/photos/error_input.svg" alt="photos"></span>
                </div>
                <div>
                    <input  type="password" id="main_password" name="password" placeholder="Пароль" v-model="password">
                    <span v-show="password!=password2 || password==''" class="clue" data-clue="Пароли не совпадают"><img src="../../../../public/photos/error_input.svg" alt="photos"></span>
                </div>
                <div>
                    <input type="password" id="again_password" placeholder="Подтверждение пароля" v-model="password2">
                    <span v-show="password!=password2 || password2==''" class="clue" data-clue="Пароли не совпадают"><img src="../../../../public/photos/error_input.svg" alt="photos"></span>
                </div>
            </div>
            <div class="registration_settings">
                <label for="user_agree" class="label_remember_me">
                    <input v-model="confirmAgreement" type="checkbox" id="user_agree" class="remember_me">
                    <span class="custom_checkbox_registration"></span>
                    <span>Я принимаю условия Пользовательского соглашения</span>
                </label>
                <label for="personal_data" class="label_remember_me">
                    <input type="checkbox" v-model="confirmData" id="personal_data" class="remember_me">
                    <span class="custom_checkbox_registration"></span>
                    <span>Даю согласие на обработку персональных данных</span>
                </label>
            </div>
            <button 
            :disabled="confirmData==false || confirmAgreement==false || email.length<2 
            || name.length<2 || surname.length<2 ||
             phone.length<2 || password!=password2 || password=='' || password2==''" 
            class="button_registration" >Зарегистрироваться</button>
            </form>
        </div>
        <div class="registration_img">
            <div class="registration_vector">
                <h1>Мы рады<br>приветствовать Вас</h1>
            </div>
        </div>
    </section>

</template>
  
<script>
import {mask, setCursorPosition} from '../../helperNumber.js'
    
export default{
    props:[],
    data(){
        return{
            name:'',
            surname:'',
            email:'',
            confirmData:false,
            confirmAgreement:false,
            phone:'',
            password:'',
            password2:'',
        }
    },
    methods:{
 
 
    },
    watch:{
        phone(newValue,oldValue){
            if(newValue.length>17){
                newValue.substring(0, 17);
            }
        }
    },
    mounted(){
      window.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector("#online_phone");
    input.addEventListener("input", mask, false);
    setCursorPosition(3, input);
  })
    },
   
}
</script>

<style scoped>
button:disabled,
button[disabled]{
  border: 1px solid #999999;
  background-color: #cccccc;
  color: #666666;
}
</style>
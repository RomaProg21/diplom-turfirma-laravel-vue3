function toggleLoginPopup() {
  const loginPopup = document.getElementById("loginPopup");
  const overlay = document.getElementById("overlay");
  if (loginPopup.style.display === "block") {
    loginPopup.style.display = "none";
    overlay.style.display = "none";
  } else {
    loginPopup.style.display = "block";
    overlay.style.display = "block";
  }
}
document.addEventListener("DOMContentLoaded", function() {
  var input = document.getElementById('departure-date');
  input.value = ''; // Устанавливаем пустое значение по умолчанию
  input.setAttribute('placeholder', 'Выберите дату'); // Устанавливаем placeholder

  input.addEventListener('focus', function() {
    input.type = 'date';
  });
  input.addEventListener('blur', function() {
    if (input.value === '') {
      input.type = 'text';
      input.setAttribute('placeholder', 'Выберите дату');
    }
  });
});
//Шаблон для Имени пользователя
document.getElementById('firstname').addEventListener('input', function(event) {
  let input = event.target;
  let value = input.value.replace(/[^А-Яа-я]/g, ''); // Оставляем только русские буквы
  input.value = value.charAt(0).toUpperCase() + value.slice(1); // Первая буква в верхнем регистре
});
//Шаблон для Фамилии пользователя 
document.getElementById('lastname').addEventListener('input', function(event) {
  let input = event.target;
  let value = input.value.replace(/[^А-Яа-я]/g, ''); // Оставляем только русские буквы
  input.value = value.charAt(0).toUpperCase() + value.slice(1); // Первая буква в верхнем регистре
});
//Шаблон для Почты
document.getElementById('main_email').addEventListener('input', function(event) {
  let input = event.target;
  let value = input.value.replace(/[^a-zA-Z@.]/g, ''); // Удаление всех символов, кроме английских букв, @ и .
  input.value = value; // Устанавливаем отформатированное значение в поле
});
// Шаблон для Номера телеофна
document.getElementById('main_telephon').addEventListener('input', function(event) {
  let input = event.target;
  let value = input.value.replace(/\D/g, ''); // Удаление всех нецифровых символов
  let formattedValue = '';
  // Если первая цифра 8, заменяем её на 7
  if (value.charAt(0) === '8') {
      value = '7' + value.slice(1);
  }
  // Ограничиваем количество символов до 11
  value = value.substring(0, 11);
  // Проверяем, есть ли символ "+" в начале строки
  let hasPlus = value.startsWith('+');
  // Если нет символа "+" в начале, добавляем его
  if (!hasPlus) {
      formattedValue += '+';
  }
  // Добавляем оставшиеся цифры
  formattedValue += value;
  input.value = formattedValue; // Устанавливаем отформатированное значение в поле
});
document.getElementById('main_telephon').addEventListener('keydown', function(event) {
let input = event.target;
let value = input.value;
// Если нажата клавиша Backspace и строка не пуста
if (event.key === 'Backspace' && value.length > 0) {
    // Если строка заканчивается на "+", удаляем первые два символа
    if (value.endsWith('+')) {
        let newValue = value.slice(0, -2); // Удаляем последние два символа
        input.value = newValue; // Устанавливаем новое значение поля
    } else {
        let newValue = value.slice(0, -1); // Удаляем последний символ
        input.value = newValue; // Устанавливаем новое значение поля
    }
    event.preventDefault(); // Предотвращаем стандартное поведение клавиши Backspace
}
});
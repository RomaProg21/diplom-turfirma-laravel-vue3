//Функционал для разворачивания блоков в Профиле
document.addEventListener('DOMContentLoaded', function() {
    const blockHeaders = document.querySelectorAll('.block-header');
    
    blockHeaders.forEach(header => {
        header.addEventListener('click', function() {
            const content = this.nextElementSibling;
            content.classList.toggle('closed');
            this.parentElement.classList.toggle('opened');
        });
    });
});
//Функционал для добавления и удаления документов
document.addEventListener('DOMContentLoaded', function() {
  const addPassportBtn = document.querySelector('.add-passport');
  const addInternationalPassportBtn = document.querySelector('.add-international-passport');
  const passportForm = document.querySelector('.passport-form');
  const internationalPassportForm = document.querySelector('.international-passport-form');

  addPassportBtn.addEventListener('click', function() {
      addPassportBtn.style.display = 'none';
      passportForm.classList.remove('hidden');
  });

  addInternationalPassportBtn.addEventListener('click', function() {
      addInternationalPassportBtn.style.display = 'none';
      internationalPassportForm.classList.remove('hidden');
  });

  document.querySelectorAll('.delete-passport').forEach(function(btn) {
      btn.addEventListener('click', function() {
          addPassportBtn.style.display = 'block';
          passportForm.classList.add('hidden');
          // Очистить значения полей ввода в форме паспорта
          passportForm.querySelectorAll('.personal_info_input').forEach(function(input) {
              input.value = '';
          });
      });
  });

  document.querySelectorAll('.delete-international-passport').forEach(function(btn) {
      btn.addEventListener('click', function() {
          addInternationalPassportBtn.style.display = 'block';
          internationalPassportForm.classList.add('hidden');
          // Очистить значения полей ввода в форме международного паспорта
          internationalPassportForm.querySelectorAll('.personal_info_input').forEach(function(input) {
              input.value = '';
          });
      });
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
//Шаблон для Отчества пользователя 
document.getElementById('fullname').addEventListener('input', function(event) {
    let input = event.target;
    let value = input.value.replace(/[^А-Яа-я]/g, ''); // Оставляем только русские буквы
    input.value = value.charAt(0).toUpperCase() + value.slice(1); // Первая буква в верхнем регистре
});
//Шаблон для Даты рождения пользователя
document.addEventListener("DOMContentLoaded", function() {
  var input = document.getElementById('date_of_birth');

  input.addEventListener('focus', function() {
    input.type = 'date';
  });

  input.addEventListener('blur', function() {
    if (input.value === '') {
      input.type = 'text';
      input.placeholder = 'Дата рождения';
    }
  });
  // Добавляем обработчик ввода для проверки количества символов в году
  input.addEventListener('input', function(event) {
    var value = event.target.value;
    var parts = value.split('-'); // Разбиваем введенное значение на части
    if (parts.length === 3 && parts[0].length > 4) { // Проверяем, что год содержит более 4 символов
      parts[0] = parts[0].substring(0, 4); // Обрезаем год до 4 символов
      event.target.value = parts.join('-'); // Собираем обновленное значение обратно
    }
  });
});
//Шаблон для Серии и Номера Паспорта
document.getElementById('passport_number').addEventListener('input', function(event) {
  let input = event.target;
  let value = input.value.replace(/\D/g, ''); // Удаление всех нецифровых символов
  let formattedValue = '';

  if (value.length > 4) { // Если введена серия паспорта
    formattedValue += value.substring(0, 4) + ' '; // Добавление пробела после серии
    value = value.substring(4); // Удаление серии из строки
  }

  if (value.length > 6) { // Ограничение длины вводимой строки до 10 цифр
    value = value.substring(0, 6);
  }

  formattedValue += value; // Добавление номера

  input.value = formattedValue; // Установка отформатированного значения в поле
});
//Шаблон для Дата выдачи Паспорта
document.addEventListener("DOMContentLoaded", function() {
  var input = document.getElementById('passport_date');

  input.addEventListener('focus', function() {
    input.type = 'date';
  });

  input.addEventListener('blur', function() {
    if (input.value === '') {
      input.type = 'text';
      input.placeholder = 'Дата выдачи';
    }
  });
  
  // Добавляем обработчик ввода для проверки количества символов в году
  input.addEventListener('input', function(event) {
    var value = event.target.value;
    var parts = value.split('-'); // Разбиваем введенное значение на части
    if (parts.length === 3 && parts[0].length > 4) { // Проверяем, что год содержит более 4 символов
      parts[0] = parts[0].substring(0, 4); // Обрезаем год до 4 символов
      event.target.value = parts.join('-'); // Собираем обновленное значение обратно
    }
  });
});
// Шаблон для Кода подразделения у паспорта
document.getElementById('passport_kod').addEventListener('input', function(event) {
    let input = event.target;
    let value = input.value.replace(/\D/g, ''); // Удаление всех нецифровых символов
    let formattedValue = '';
  
    if (value.length > 3) { // Если введен код подразделения
      formattedValue += value.substring(0, 3) + '-'; // Добавление дефиса после первых трех цифр
      value = value.substring(3); // Удаление первых трех цифр из строки
    }
  
    if (value.length > 3) { // Ограничение длины вводимой строки до 6 цифр
      value = value.substring(0, 3);
    }
  
    formattedValue += value; // Добавление оставшихся цифр
  
    input.value = formattedValue; // Установка отформатированного значения в поле
});
// Шаблон для Серии и Номера Загранпаспорта
document.getElementById('international_passport_number').addEventListener('input', function(event) {
  let input = event.target;
  let value = input.value.replace(/\D/g, ''); // Удаление всех нецифровых символов
  let formattedValue = '';

  if (value.length > 2) { // Если введена серия паспорта
    formattedValue += value.substring(0, 2) + ' '; // Добавление пробела после первых двух символов
    value = value.substring(2); // Удаление первых двух символов из строки
  }

  if (value.length > 7) { // Ограничение длины вводимой строки до 8 цифр
    value = value.substring(0, 7);
  }

  formattedValue += value; // Добавление номера

  input.value = formattedValue; // Установка отформатированного значения в поле
});
//Шаблон для Даты выдачи Загранпаспорта
document.addEventListener("DOMContentLoaded", function() {
  var input = document.getElementById('international_passport_date');

  input.addEventListener('focus', function() {
    input.type = 'date';
  });

  input.addEventListener('blur', function() {
    if (input.value === '') {
      input.type = 'text';
      input.placeholder = 'Дата выдачи';
    }
  });
  // Добавляем обработчик ввода для проверки количества символов в году
  input.addEventListener('input', function(event) {
    var value = event.target.value;
    var parts = value.split('-'); // Разбиваем введенное значение на части
    if (parts.length === 3 && parts[0].length > 4) { // Проверяем, что год содержит более 4 символов
      parts[0] = parts[0].substring(0, 4); // Обрезаем год до 4 символов
      event.target.value = parts.join('-'); // Собираем обновленное значение обратно
    }
  });
});
//Шаблон для Срока действия Загранпаспорта
document.addEventListener("DOMContentLoaded", function() {
  var input = document.getElementById('international_passport_enddate');
  input.addEventListener('focus', function() {
    input.type = 'date';
  });
  input.addEventListener('blur', function() {
    if (input.value === '') {
      input.type = 'text';
      input.placeholder = 'Срок действия';
    }
  });
  // Добавляем обработчик ввода для проверки количества символов в году
  input.addEventListener('input', function(event) {
    var value = event.target.value;
    var parts = value.split('-'); // Разбиваем введенное значение на части
    if (parts.length === 3 && parts[0].length > 4) { // Проверяем, что год содержит более 4 символов
      parts[0] = parts[0].substring(0, 4); // Обрезаем год до 4 символов
      event.target.value = parts.join('-'); // Собираем обновленное значение обратно
    }
  });
});
//Функционал для Банковских карт
document.addEventListener("DOMContentLoaded", function() {
    var addCardButton = document.getElementById('addCardButton');
    var modal = document.getElementById('modal');
    var closeBtn = document.querySelector('.close');
    // Функция для сброса значений полей формы всплывающего окна
    function resetForm() {
        document.getElementById('cardNumber').value = '';
        document.getElementById('cardName').value = '';
    }
    // Открытие модального окна при нажатии на кнопку "Добавить карту"
    addCardButton.addEventListener('click', function() {
        modal.style.display = 'block';
        resetForm(); // Сбрасываем значения полей формы
    });
    // Закрытие модального окна при нажатии на кнопку закрытия
    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });
    // Сохранение карты и закрытие модального окна при нажатии на кнопку "Сохранить"
    var saveCardButton = document.getElementById('saveCardButton');
    saveCardButton.addEventListener('click', function() {
        var cardNumber = document.getElementById('cardNumber').value;
        var cardName = document.getElementById('cardName').value;
        var newCard = document.createElement('div');
        newCard.textContent = "Номер карты: " + cardNumber + ", Имя на карте: " + cardName;
        var deleteButton = document.createElement('button');
        deleteButton.textContent = 'Удалить';
        deleteButton.classList.add('deleteCardButton');
        newCard.appendChild(deleteButton);
        var cardList = document.getElementById('cardList');
        cardList.appendChild(newCard);
        modal.style.display = 'none'; // Закрываем модальное окно после сохранения карты
        resetForm(); // Сбрасываем значения полей формы
        // Добавляем обработчик для удаления карты
        deleteButton.addEventListener('click', function() {
        cardList.removeChild(newCard);
      });
    });
});
// Шаблон для Основного номера телеофна
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
//Шаблон для Дополнительного номера
document.getElementById('other_telephon').addEventListener('input', function(event) {
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
document.getElementById('other_telephon').addEventListener('keydown', function(event) {
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
// настройка скрипта CallMe 1.9.5
// по-русски: dedushka.org // in English: nazarTokar.com // форум: qbx.me // a@dedushka.org
// updated on 2013-12-30

// отображать ли снопку вызова скрипта справа (1 - да, 0 - нет)
var cme_bt = 1; 

// укажите через запятую названия полей
// textarea - ставьте перед названием минус (-)
// select - ставьте перед названием "!" и разделяйте варианты для выбора таким же символом
var cme_fields = "+Телефон"; 

// надпись на кнопке в форме
var cme_title = "Заказать бесплатный звонок"; 

// заголовок формы
var cme_button = "Перезвоните мне"; 

// показывать ли время звонка (0 - нет, 1 - да)
var cme_calltime = 1; 

// если указать 1, форма будет по центру экрана, если 0, будет появляться у места клика
var cme_center = 1;

// начало и конец рабочего дня в часах, используется для времени звонка
var cme_start_work = 8;
var cme_end_work = 19;

// название папки с темплейтом (default, vk, fb, blackred, hkitty)
var cme_template = 'fb';

// папка со скриптом
var cme_folder = "/callme/";

// лицензия (можно купить на get.nazartokar.com)
var cme_license = 0;
var cme_show_cr = 0;
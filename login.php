<!DOCTYPE html>
<html lang="ru">
<script>
    // Добавляем скрипт инициализации темы до загрузки DOM
    const savedTheme = localStorage.getItem('theme') || 'dark';
    if (savedTheme === 'dark') {
        document.documentElement.classList.add('dark-theme');
    }
</script>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BGA - login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Добавьте в конец существующих стилей */

        /* Стили для алертов */
        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-top: 15px;
            animation: fadeIn 0.3s;
        }

        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.2);
        }

        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .alert-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
            border: 1px solid rgba(255, 193, 7, 0.2);
        }

        /* Анимация появления */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Стили для невалидных полей */
        .form-control.is-invalid {
            border-color: var(--danger-color, #dc3545);
            animation: shake 0.5s;
        }

        /* Анимация встряхивания для ошибок */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Стили для индикатора загрузки */
        .loading-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .loading-indicator.show {
            opacity: 1;
        }

        .spinner-wrapper {
            text-align: center;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
            color: var(--accent-blue);
        }

        .loading-text {
            color: #fff;
            margin-top: 1rem;
            font-size: 14px;
        }

        /* Стили для переключателя темы */
        .theme-toggle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-1);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            transform: translateY(-2px);
        }

        .theme-toggle i {
            position: absolute;
            transition: all 0.3s ease;
        }

        .theme-toggle .fa-sun {
            opacity: 1;
            transform: translateY(0);
        }

        .theme-toggle .fa-moon {
            opacity: 0;
            transform: translateY(20px);
        }

        /* Анимация для тёмной темы */
        .dark-theme .theme-toggle .fa-sun {
            opacity: 0;
            transform: translateY(-20px);
        }

        .dark-theme .theme-toggle .fa-moon {
            opacity: 1;
            transform: translateY(0);
        }

        /* Добавляем вращение при переключении */
        .theme-toggle.switching {
            animation: rotate 0.5s ease;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Стили для подсказок полей */
        .input-hint {
            color: #4B8BF4;
            font-size: 11px;
            margin: 4px 0 12px 2px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .input-hint i {
            color: #4B8BF4;
            font-size: 12px;
            width: 12px;
            height: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.8;
        }

        /* Стили для input-with-icon */
        .input-with-icon {
            margin-bottom: 0;
            position: relative;
        }

        /* Обновляем стили для form-group */
        .form-group {
            margin-bottom: 4px;
        }

        /* Стили для dark-theme */
        .dark-theme .input-hint,
        .dark-theme .input-hint i,
        .dark-theme .input-with-icon i {
            color: #4B8BF4;
        }

        .dark-theme .input-hint {
            opacity: 0.7;
        }

        /* Убираем анимацию для более чистого вида */
        .input-hint {
            animation: none;
        }
    </style>
</head>
<body>
  

    <div class="container-fluid p-3 app-container">
       
    <?php include 'components/miniHeader.php'; ?>
    

        <!-- Форма входа/регистрации -->
        <div class="auth-container">
            <!-- Переключатель форм -->
            <div class="auth-toggle mb-4">
                <button class="active" data-form="login">Вход</button>
                <button data-form="register">Регистрация</button>
            </div>

            <!-- Форма входа -->
            <form id="loginForm" class="auth-form active" autocomplete="off">
                <div class="form-group mb-3">
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control" placeholder="Email" required autocomplete="off">
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" class="form-control" placeholder="Пароль" required autocomplete="new-password">
                        <button type="button" class="password-toggle">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">Запомнить меня</label>
                    </div>
                    <a href="forgot-password.php" class="forgot-password">Забыли пароль?</a>
                </div>
                <button type="submit" class="btn btn-primary w-100">Войти</button>
                
                <!-- Изменяем id для блока ответа -->
                <div id="loginApiResponse" class="mt-3" style="display: none;">
                    <div class="alert" role="alert"></div>
                </div>
            </form>

            <!-- Фрма регистраци -->
            <form id="registerForm" class="auth-form" autocomplete="off">
                <div class="form-group mb-3">
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input name="name" type="text" class="form-control" placeholder="Имя" required autocomplete="off">
                    </div>
                </div>

                <!-- Добавляем поле для номера телефона -->
                <div class="form-group mb-3">
                    <div class="input-with-icon">
                        <i class="fas fa-phone"></i>
                        <input type="tel" class="form-control" placeholder="Номер телефона" required autocomplete="off" 
                               pattern="[\+]?[0-9]{12}" title="Формат: +998 XX XXX XX XX">
                    </div>
                </div>

                 <!-- Добавляем поле для Telegram username -->
                 <div class="form-group mb-3">
                    <div class="input-with-icon">
                        <i class="fab fa-telegram"></i>
                        <input type="text" 
                               class="form-control" 
                               name="telegram"
                
                               
                               required 
                               autocomplete="off">
                    </div>
                    <div class="input-hint">
                        <i class="fas fa-circle-info"></i>
                        Например: https://t.me/sanjar_3210
                    </div>
                </div>

                <!-- Селектор категории -->
                <div class="form-group mb-3">
                    <div class="input-with-icon">
                        <i class="fas fa-tag"></i>
                        <select class="form-control category-select" required autocomplete="off">
                            <option value="" disabled selected data-translate="auth.selectCategory">Выберите категорию</option>
                            <option value="blogger" data-translate="auth.categories.blogger">Блогер</option>
                            <option value="company" data-translate="auth.categories.company">Компания</option>
                            <option value="freelancer" data-translate="auth.categories.freelancer">Фрилансер</option>
                        </select>
                    </div>
                </div>

                <!-- После селектора категории -->
                <div class="form-group mb-3 direction-selects-container" style="display: none;">
                    <div class="input-with-icon">
                        <i class="fas fa-compass"></i>

                        <!-- Направления для блогеров -->
                        <select class="form-control direction-blogger" autocomplete="off" style="display: none;">
                            <option value="" disabled selected>Выберите направление</option>
                            <option value="lifestyle">Лайфстайл и влог</option>
                            <option value="fashion">Мода и стиль</option>
                            <option value="beauty">Бьюти и косметика</option>
                            <option value="travel">Путешествия и туризм</option>
                            <option value="food">Еда и кулинария</option>
                            <option value="sport">Спорт и фитнес</option>
                            <option value="business">Бизнес и предпринимательство</option>
                            <option value="education">Образование и саморазвитие</option>
                            <option value="technology">Технологии и гаджеты</option>
                            <option value="gaming">Игры и киберспорт</option>
                            <option value="music">Музыка и развлечения</option>
                            <option value="art">Искусство и творчество</option>
                            <option value="health">Здоровье и wellness</option>
                            <option value="parenthood">Родительство и семья</option>
                            <option value="pets">Домашние животные</option>
                            <option value="cars">Автомобили и транспорт</option>
                            <option value="finance">Финансы и инвестиции</option>
                            <option value="motivation">Мотивация и психология</option>
                        </select>

                        <!-- Направления для компаний -->
                        <select class="form-control direction-company" autocomplete="off" style="display: none;">
                            <option value="" disabled selected>Выберите направление</option>
                            <option value="retail">Розничная торговля</option>
                            <option value="wholesale">Оптовая торговля</option>
                            <option value="services">Услуги и сервис</option>
                            <option value="manufacturing">Производство</option>
                            <option value="tech">IT и технологии</option>
                            <option value="finance">Финансы и банкинг</option>
                            <option value="construction">Строительство</option>
                            <option value="realestate">Недвижимость</option>
                            <option value="healthcare">Здравоохранение</option>
                            <option value="education">Образование</option>
                            <option value="hospitality">Гостиничный бизнес</option>
                            <option value="restaurant">Рестораны и общепит</option>
                            <option value="logistics">Логистика</option>
                            <option value="agriculture">Сельское хозяйство</option>
                            <option value="energy">Энергетика</option>
                            <option value="media">Медиа и развлечения</option>
                            <option value="consulting">Консалтинг</option>
                            <option value="automotive">Автомобильный бизнес</option>
                            <option value="mall">Торговые центры</option>
                        </select>

                        <!-- Направления для фрилансеров -->
                        <select class="form-control direction-freelancer" autocomplete="off" style="display: none;">
                            <option value="" disabled selected>Выберите направление</option>
                            <option value="webdev">Веб-разработка</option>
                            <option value="mobiledev">Мобильная разработка</option>
                            <option value="uidesign">UI/UX Дизайн</option>
                            <option value="graphicdesign">Графический дизайн</option>
                            <option value="marketing">Маркетинг</option>
                            <option value="smm">SMM</option>
                            <option value="copywriting">Копирайтинг</option>
                            <option value="translation">Перевод</option>
                            <option value="video">Видеопроизводство</option>
                            <option value="animation">Анимация</option>
                            <option value="voiceover">Озвучка</option>
                            <option value="photography">Фотография</option>
                            <option value="3d">3D моделирование</option>
                            <option value="gamedev">Разработка игр</option>
                            <option value="seo">SEO-оптимизация</option>
                            <option value="analytics">Аналитика</option>
                            <option value="consulting">Консультирование</option>
                            <option value="projectmanagement">Управление проектами</option>
                        </select>
                    </div>
                </div>

               

                <div class="form-group mb-3">
                    <div class="input-with-icon">
                        <i class="fab fa-instagram"></i>
                        <input type="text" 
                               class="form-control" 
                               name="instagram"
                               placeholder="сылка на Instagram"
                               data-placeholder="instagram"
                               required 
                               autocomplete="off">
                    </div>
                    <div class="input-hint">
                        <i class="fas fa-circle-info"></i>
                        Вставьте ссылку на ваш Instagram
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" class="form-control" placeholder="Email" required autocomplete="off">
                    </div>
                    <div class="input-hint">
                        <i class="fas fa-circle-info"></i>
                        На email придет код подтверждения
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input name="password" type="password" class="form-control" placeholder="Пароь" required autocomplete="new-password">
                        <button type="button" class="password-toggle">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input name="confirm_password" type="password" class="form-control" placeholder="Подтвердите пароль" required autocomplete="new-password">
                        <button type="button" class="password-toggle">
                            <i class="far fa-eye"></i>
                        </button>
                        <div class="invalid-feedback">
                            Пароли не совпадают
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
                
                <!-- Изменяем id для блока ответа -->
                <div id="registerApiResponse" class="mt-3" style="display: none;">
                    <div class="alert" role="alert"></div>
                </div>
            </form>


        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="translations.js"></script>
    <script>

        let params = new URLSearchParams(document.location.search);
        const tgChatId = params.get('tg_chat_id');
        localStorage.setItem('tg_chat_id', tgChatId)




        function showLoading() {
            const loader = document.getElementById('loadingIndicator');
            loader.style.display = 'flex';
            setTimeout(() => loader.classList.add('show'), 10);
        }

        function hideLoading() {
            const loader = document.getElementById('loadingIndicator');
            loader.classList.remove('show');
            setTimeout(() => {
                loader.style.display = 'none';
            }, 300);
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Переключение форм
            const toggleButtons = document.querySelectorAll('.auth-toggle button');
            const forms = document.querySelectorAll('.auth-form');

            toggleButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const formType = button.getAttribute('data-form');
                    
                    // Переключаем активную кнопку
                    toggleButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');

                    // Переключаем активную форму
                    forms.forEach(form => {
                        form.classList.remove('active');
                        if (form.id === `${formType}Form`) {
                            form.classList.add('active');
                        }
                    });
                });
            });

            // Заменяем существующий обработчик показа/скрытия пароля на этот:
            const passwordToggles = document.querySelectorAll('.password-toggle');

            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const inputWithIcon = this.closest('.input-with-icon');
                    const input = inputWithIcon.querySelector('input');
                    const icon = this.querySelector('i');
                    
                    // Просто меняем тип поля
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                    
                    // Сохраняем фокус на поле
                    input.focus();
                });
            });

            // Инициалиация языка
            const langButtons = document.querySelectorAll('.lang-toggle button');
            langButtons.forEach(button => {
                button.addEventListener('click', () => {
                    langButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                    const lang = button.textContent.toLowerCase();
                    updateLanguage(lang);
                });
            });

            function updateLanguage(lang) {
                const t = translations[lang];
                if (!t) return;

                // Обновляем тексты форм
                document.querySelector('[data-form="login"]').textContent = t.auth.login;
                document.querySelector('[data-form="register"]').textContent = t.auth.register;
                
                // Обновляем плейсхолдеры и тексты входа
                document.querySelectorAll('#loginForm input[type="email"]').forEach(input => {
                    input.placeholder = t.auth.email;
                });
                document.querySelectorAll('#loginForm input[type="password"]').forEach(input => {
                    input.placeholder = t.auth.password;
                });
                document.querySelector('#rememberMe').nextElementSibling.textContent = t.auth.rememberMe;
                document.querySelector('.forgot-password').textContent = t.auth.forgotPassword;
                document.querySelector('#loginForm button[type="submit"]').textContent = t.auth.loginButton;

                // Обновляем форму регистрации
                document.querySelector('#registerForm input[type="text"]').placeholder = t.auth.name;
                document.querySelector('#registerForm input[type="tel"]').placeholder = t.auth.phone;
                document.querySelectorAll('#registerForm input[type="email"]').forEach(input => {
                    input.placeholder = t.auth.email;
                });
                document.querySelectorAll('#registerForm input[type="password"]')[0].placeholder = t.auth.password;
                document.querySelectorAll('#registerForm input[type="password"]')[1].placeholder = t.auth.confirmPassword;
                document.querySelector('#registerForm button[type="submit"]').textContent = t.auth.registerButton;

                // Обновляем селектор атегорий
                const categorySelect = document.querySelector('.category-select');
                if (categorySelect) {
                    // Обновляем placeholder опцию
                    categorySelect.options[0].textContent = t.auth.selectCategory;
                    // Обновляем остальные опции
                    Array.from(categorySelect.options).forEach(option => {
                        const translateKey = option.getAttribute('data-translate');
                        if (translateKey) {
                            const keys = translateKey.split('.');
                            let translation = t;
                            keys.forEach(key => {
                                translation = translation[key];
                            });
                            if (translation) {
                                option.textContent = translation;
                            }
                        }
                    });
                }

                document.querySelector('.social-auth p').textContent = t.auth.orLoginWith;

                localStorage.setItem('selectedLanguage', lang);
            }

            // Загружаем схраненный язык
            const savedLanguage = localStorage.getItem('selectedLanguage') || 'ru';
            const savedLangButton = Array.from(langButtons).find(
                button => button.textContent.toLowerCase() === savedLanguage
            );
            if (savedLangButton) {
                savedLangButton.click();
            }

            // Обработчик регистрации
            const registerForm = document.getElementById('registerForm');
            if (registerForm) {
                registerForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    
                    const direction = registerForm.querySelector(`[name="direction"]`)?.value;
                    const telegram = registerForm.querySelector('input[name="telegram"]')?.value.trim();
                    
                    if (!direction) {
                        const alertBlock = document.getElementById('registerApiResponse').querySelector('.alert');
                        alertBlock.className = 'alert alert-danger';
                        alertBlock.textContent = 'Пожалуйста, выберите направление';
                        alertBlock.style.display = 'block';
                        return;
                    }
                    
                    if (!telegram) {
                        const alertBlock = document.getElementById('registerApiResponse').querySelector('.alert');
                        alertBlock.className = 'alert alert-danger';
                        alertBlock.textContent = 'Пожалуйста, укажите Telegram username';
                        alertBlock.style.display = 'block';
                        return;
                    }
                    
                    showLoading();
                    
                    const responseBlock = document.getElementById('registerApiResponse');
                    const alertBlock = responseBlock.querySelector('.alert');
                    const tg_chat_id = localStorage.getItem('telegram_chat_id');
                    const tg_user_id = localStorage.getItem('telegram_user_id');
                    
                    try {
                        // Добавьте эти стоки перед отправкой запроса
                        console.log('Direction:', registerForm.querySelector(`[name="direction"]`)?.value);
                        console.log('Telegram:', registerForm.querySelector('input[name="telegram"]')?.value);

                        // Изменяем способ получения пароля
                        const formData = {
                            name: registerForm.querySelector('input[type="text"]').value.trim(),
                            phone: registerForm.querySelector('input[type="tel"]').value.trim(),
                            email: registerForm.querySelector('input[type="email"]').value.trim(),
                            password: registerForm.querySelector('input[name="password"]').value,
                            category: registerForm.querySelector('.category-select').value,
                            // Добавляем новые поля
                            direction: registerForm.querySelector(`[name="direction"]`)?.value || '',
                            telegram: registerForm.querySelector('input[name="telegram"]')?.value.trim(),
                            instagram: registerForm.querySelector('input[name="instagram"]')?.value.trim(),
                            tg_chat_id: "chat_id",
                            tg_user_id: "user_id",
                            
                        };

                        // Логируем данные
                        console.log('Отправляемые данные (register):', formData);

                        const response = await fetch('http://localhost:8888/api/auth/register', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(formData)
                        });

                        const data = await response.json();
                        // Логируем ответ
                        console.log('Ответ сервера (register):', data);
                        console.log('Статус ответа:', response.status);

                        responseBlock.style.display = 'block';

                        if (response.status === 200) {
                            alertBlock.className = 'alert alert-success';
                            alertBlock.textContent = data.message;
                            
                            localStorage.setItem('userRegistrationData', JSON.stringify({
                                email: formData.email,
                                name: formData.name
                            }));
                            console.log(formData.tg_chat_id);
                            setTimeout(() => {
                                window.location.href = 'otp.php';
                            }, 1000);
                        } else {
                            alertBlock.className = 'alert alert-danger';
                            alertBlock.textContent = data.error;
                        }
                    } catch (error) {
                        console.error('Ошибка при регистрации:', error);
                        responseBlock.style.display = 'block';
                        alertBlock.className = 'alert alert-danger';
                        alertBlock.textContent = error.message;
                    } finally {
                        hideLoading();
                    }
                });
            }

            // Обработчик входа
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', async (e) => {
                    e.preventDefault();
                    
                    showLoading();
                    
                    const responseBlock = document.getElementById('loginApiResponse');
                    const alertBlock = responseBlock.querySelector('.alert');
                    
                    try {
                        const formData = {
                            email: loginForm.querySelector('input[type="email"]').value.trim(),
                            password: loginForm.querySelector('input[type="password"], input[type="text"]').value
                        };

                        // Логируем данные, которые отправляем
                        console.log('Отправляемые данные (login):', formData);

                        const response = await fetch('http://localhost:8888/api/auth/login', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify(formData)
                        });

                        const data = await response.json();
                        // Логируем ответ сервера
                        console.log('Ответ сервера (login):', data);
                        console.log('Статус ответа:', response.status);

                        responseBlock.style.display = 'block';

                        if (response.status === 200) {
                            alertBlock.className = 'alert alert-success';
                            alertBlock.textContent = data.message;
                            

                            localStorage.setItem('userEmail',data.user.email);
                            localStorage.setItem('category',data.user.category );
                            localStorage.setItem('verified',data.user.is_verified);
                            localStorage.setItem('userId',data.user.id);
                            localStorage.setItem('direction',data.user.direction);
                            localStorage.setItem('telegram',data.user.telegram);
                            localStorage.setItem('instagram',data.user.instagram);
                            localStorage.setItem('name',data.user.name);
                            localStorage.setItem('phone',data.user.phone);
                            
                            setTimeout(() => {
                                window.location.href = 'index.php';
                            }, 1000);
                        } else if (response.status === 401 && data.isVerified === false) {
                            alertBlock.className = 'alert alert-warning';
                            alertBlock.textContent = data.error;
                            
                            localStorage.setItem('userRegistrationData', JSON.stringify({
                                email: formData.email
                            }));
                            
                            setTimeout(() => {
                                window.location.href = 'otp.php';
                            }, 1000);
                        } else {
                            alertBlock.className = 'alert alert-danger';
                            alertBlock.textContent = data.error;
                        }
                    } catch (error) {
                        console.error('Ошибка при входе:', error);
                        responseBlock.style.display = 'block';
                        alertBlock.className = 'alert alert-danger';
                        alertBlock.textContent = 'Ошибка при попытке входа';
                    } finally {
                        hideLoading();
                    }
                });
            }

            // Дбавьте этот код после инициализации формы
            const passwordInput = registerForm.querySelectorAll('input[type="password"]')[0];
            const confirmPasswordInput = registerForm.querySelectorAll('input[type="password"]')[1];

            // Функция проверки совпадения паролей
            function validatePasswords() {
                if (confirmPasswordInput.value === '') {
                    confirmPasswordInput.classList.remove('is-valid', 'is-invalid');
                    return;
                }
                
                if (passwordInput.value === confirmPasswordInput.value) {
                    confirmPasswordInput.classList.remove('is-invalid');
                    confirmPasswordInput.classList.add('is-valid');
                } else {
                    confirmPasswordInput.classList.remove('is-valid');
                    confirmPasswordInput.classList.add('is-invalid');
                }
            }

            // Добавляем слушатели событий
            passwordInput.addEventListener('input', validatePasswords);
            confirmPasswordInput.addEventListener('input', validatePasswords);

            // Обработчик изменения категории
            const categorySelect = document.querySelector('.category-select');
            const directionContainer = document.querySelector('.direction-selects-container');
            const directionSelects = {
                blogger: document.querySelector('.direction-blogger'),
                company: document.querySelector('.direction-company'),
                freelancer: document.querySelector('.direction-freelancer')
            };

            categorySelect.addEventListener('change', function() {
                const selectedCategory = this.value;
                
                // Сначала скрываем все селекты и убираем required
                Object.values(directionSelects).forEach(select => {
                    select.style.display = 'none';
                    select.removeAttribute('name');
                    select.removeAttribute('required'); // Убираем required у скрытых селектов
                });
                
                // Снчала проверяем выбрана ли категория
                if (!selectedCategory) {
                    directionContainer.style.display = 'none';
                    return;
                }
                
                // Показываем контейнер если выбрана категория
                directionContainer.style.display = 'block';
                
                // Показываем нужный селект
                const directionSelect = directionSelects[selectedCategory];
                if (directionSelect) {
                    directionSelect.style.display = 'block';
                    directionSelect.setAttribute('name', 'direction');
                    directionSelect.setAttribute('required', 'required'); // Добавляем required только активном селекту
                    
                    // Сбрасываем выбранное значение
                    directionSelect.selectedIndex = 0;
                }
            });

            // Добавляем стили для корректного отображения
            const style = document.createElement('style');
            style.textContent = `
                .direction-selects-container {
                    margin-top: -8px;
                }
                .direction-selects-container select {
                    width: 100%;
                    background-color: var(--input-bg);
                    color: var(--text-color);
                    border: 1px solid var(--border-color);
                }
                .direction-selects-container select option {
                    background-color: var(--input-bg);
                    color: var(--text-color);
                    padding: 8px;
                }
                .dark-theme .direction-selects-container select option {
                    background-color: var(--dark-input-bg);
                    color: var(--dark-text-color);
                }
            `;
            document.head.appendChild(style);

            // Проверка Telegram username
            const telegramInput = document.querySelector('input[name="telegram"]');
            if (telegramInput) {
                telegramInput.addEventListener('input', function() {
                    const username = this.value.replace('https://t.me/', '');
                    
                    // Проверка формата username
                    if (username.length < 5 || !/^[a-zA-Z][a-zA-Z0-9_]{4,31}$/.test(username)) {
                        this.classList.add('is-invalid');
                        this.classList.remove('is-valid');
                        
                        // Добавляем сообщение об ошибке
                        let feedback = this.nextElementSibling;
                        if (!feedback || !feedback.classList.contains('invalid-feedback')) {
                            feedback = document.createElement('div');
                            feedback.className = 'invalid-feedback';
                            this.parentNode.appendChild(feedback);
                        }
                        feedback.textContent = 'Введите корректный username Telegram';
                    } else {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    }
                });
            }

            // Проверка Instagram ссылки
            const instagramInput = document.querySelector('input[name="instagram"]');
            if (instagramInput) {
                instagramInput.addEventListener('input', function() {
                    const value = this.value.trim();
                    
                    // Проверка формата ссылки Instagram
                   
                });
            }
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Функция для заполнения полей формы
        function fillFormFields() {
            // Получаем значения из localStorage
            const firstName = localStorage.getItem('telegram_first_name');
            const username = localStorage.getItem('telegram_username');
            const phone = localStorage.getItem('telegram_phone');
            
            console.log('Checking data:', {
                firstName: firstName,
                username: username,
                phone: phone
            });

            // Заполняем поле имени
            const nameInput = document.querySelector('input[name="name"]');
            if (nameInput && firstName) {
                nameInput.value = firstName;
                nameInput.classList.add('is-valid');
                console.log('Filled name input with:', firstName);
            }

            // Заполняем поле telegram
            const telegramInput = document.querySelector('input[name="telegram"]');
            if (telegramInput && username) {
                telegramInput.value = `https://t.me/${username}`;
                telegramInput.classList.add('is-valid');
                
            }else{
                telegramInput.value = `https://t.me/`;
               
                
            }

            // Заполняем поле телефона
            const phoneInput = document.querySelector('input[type="tel"]');
            if (phoneInput && phone) {
                phoneInput.value = phone;
                phoneInput.classList.add('is-valid');
                console.log('Filled phone input with:', phone);
            }

            // Проверяем, все ли поля заполнены
            if ((!firstName || !username || !phone) && attempts < maxAttempts) {
                attempts++;
                setTimeout(fillFormFields, 1000); // Пробуем снова через 1 секунду
                console.log('Retrying... Attempt:', attempts);
            }
        }

        // Счетчик попыток
        let attempts = 0;
        const maxAttempts = 3; // Максимальное количество попыток

        // Обработка параметров из URL
        const urlParams = new URLSearchParams(window.location.search);
        const tgdata = urlParams.get('tgdata');
        
        if (tgdata) {
            try {
                const decodedData = new URLSearchParams(tgdata);
                const params = {
                    'telegram_chat_id': decodedData.get('tg_chat_id'),
                    'telegram_user_id': decodedData.get('tg_user_id'),
                    'telegram_username': decodedData.get('tg_username'),
                    'telegram_first_name': decodedData.get('tg_first_name'),
                    'telegram_phone': decodedData.get('tg_phone'),
                    'telegram_auth_date': decodedData.get('tg_auth_date')
                };
                
                console.log('Saving parameters:', params);
                
                // Сохраняем параметры
                Object.entries(params).forEach(([key, value]) => {
                    if (value && value !== 'null' && value !== 'undefined' && value !== 'None') {
                        localStorage.setItem(key, value);
                        console.log(`Saved ${key}:`, value);
                    }
                });
            } catch (error) {
                console.error('Error processing tgdata:', error);
            }
        }

        // Запускаем первую попытку заполнения после небольшой задержки
        setTimeout(fillFormFields, 500);
    });
    </script>
    <script>
document.addEventListener('DOMContentLoaded', () => {
    // Получаем chat_id из URL
    const urlParams = new URLSearchParams(window.location.search);
    const chatId = urlParams.get('chat_id');
    
    // Если есть chat_id, сохраняем его
    if (chatId) {
        localStorage.setItem('telegram_chat_id', chatId);
        console.log('Saved telegram_chat_id on login page:', chatId);
    }
    
    // При успешной регистрации/авторизации chat_id уже будет в localStorage
    const loginForm = document.querySelector('.login-form');
    const registerForm = document.querySelector('.register-form');
    
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            // chat_id уже сохранен в localStorage
            // продолжаем обычную обработку формы
        });
    }
    
    if (registerForm) {
        registerForm.addEventListener('submit', (e) => {
            // chat_id уже сохранен в localStorage
            // продолжаем обычную обработку формы
        });
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Получаем параметры из URL
    const urlParams = new URLSearchParams(window.location.search);
    const telegramParams = {
        telegram_chat_id: urlParams.get('tg_chat_id'),
        telegram_phone: urlParams.get('tg_phone'),
        telegram_username: urlParams.get('tg_username'),
        telegram_user_id: urlParams.get('tg_user_id')
    };
    
    // Сохраняем все параметры в localStorage
    Object.entries(telegramParams).forEach(([key, value]) => {
        if (value) {
            localStorage.setItem(key, value);
            console.log('Saved ' + key + ':', value);
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM loaded, starting username check');
    
    const urlParams = new URLSearchParams(window.location.search);
    const tgUsername = urlParams.get('tg_username');
    console.log('Got tg_username from URL:', tgUsername);
    
    
});
</script>

<script src="https://telegram.org/js/telegram-web-app.js"></script>
<script>
    setTimeout(() => {
    // Ваш код здесь, который выполнится через 2 секунды
}, 3000);

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, checking for Telegram data');
    
    const urlParams = new URLSearchParams(window.location.search);
    const tgdata = urlParams.get('tgdata');
    
    if (tgdata) {
        try {
            const decodedData = new URLSearchParams(tgdata);
            const params = {
                'telegram_chat_id': decodedData.get('tg_chat_id'),
                'telegram_user_id': decodedData.get('tg_user_id'),
                'telegram_username': decodedData.get('tg_username'),
                'telegram_first_name': decodedData.get('tg_first_name'),
                'telegram_phone': decodedData.get('tg_phone'),  // Добавляем телефон
                'telegram_auth_date': decodedData.get('tg_auth_date')
            };
            
            console.log('Parameters before saving:', params);
            
            // Сохраняем параметры
            Object.entries(params).forEach(([key, value]) => {
                if (value && value !== 'null' && value !== 'undefined' && value !== 'None') {
                    localStorage.setItem(key, value);
                    console.log(`Successfully saved ${key}:`, value);
                }
            });
            
           

            const phoneInput = document.querySelector('input[type="tel"]');
            const phone = localStorage.getItem('telegram_phone');
            if (phoneInput && phone) {
                phoneInput.value = phone;
                phoneInput.classList.add('is-valid');
                console.log('Filled phone input with:', phone);
            }

        } catch (error) {
            console.error('Error details:', error);
        }
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Функция проверки наличия всех необходимых данных
    function checkRequiredData() {
        const requiredKeys = [
            'userEmail',
            'category',
            'verified',
            'userId',
            'direction',
            'telegram',
            'instagram',
            'name',
            'phone'
        ];
        
        // Проверяем наличие всех ключей
        const hasAllData = requiredKeys.every(key => {
            const value = localStorage.getItem(key);
            return value && value !== 'null' && value !== 'undefined';
        });
        
        console.log('Checking required data:', hasAllData);
        
        if (hasAllData) {
            console.log('All required data found, redirecting to index.php');
            window.location.href = 'index.php';
        }
    }
    
    // Проверяем данные при загрузке страницы
    checkRequiredData();
    
    // Также можно проверять при изменении localStorage
    window.addEventListener('storage', checkRequiredData);
});
</script>
</body>
</html> 
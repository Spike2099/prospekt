new Vue({
    el: '#shop', 
    data: {
        card: [],
        design: 'grid',
        checkout: [],
        preorder: [],
        
        searchText: '',
        allErrors: [], // Общий массив для всех ошибок
        showScrollToTop: false,

        loading: true,
        cookie: true,
        amount: 0,
        totalsumma: 0,
        button: 0,
        count: 1,
        email: '',
        search: '',
    },
    
    computed: {
        totalSum: function () {
            var sum = this.card.reduce(
                (acc, current) => acc + Number(current.summa), 0
            );
            this.totalsumma = sum;      
        },
        totalAmount: function () {
            var value = this.card.reduce(
                (acc, current) => acc + Number(current.count), 0
            );
            this.amount = value;
        },
        newOrder: function () {
            localStorage.removeItem('cart');
            localStorage.removeItem('checkout');
            this.card = [];
        }
    },
    mounted() {
        this.cookie = JSON.parse(localStorage.getItem("cookie")) || [];
        this.card = JSON.parse(localStorage.getItem('cart')) || [];
        this.checkout = JSON.parse(localStorage.getItem('checkout')) || [];
        this.preorder = JSON.parse(localStorage.getItem('preorder')) || [];
        this.design = localStorage.getItem("design") || '';

        if (localStorage.getItem('design')) {
            setTimeout(function () {
                this.loading = false;
            }.bind(this), 500);
        }

        if (localStorage.getItem('cart')) {
            try {
                setTimeout(function () {
                    this.loading = false;
                }.bind(this), 500);
                var goods = JSON.parse(localStorage.getItem('cart'));
                var set = new Set(goods.map(JSON.stringify));
                var uniqArray = Array.from(set).map(JSON.parse);
                this.card = uniqArray;
            } catch(e) {
                localStorage.removeItem('cart');
                console.log('Error:', e)
            }
        }
    
    },
    methods: {
         searchError() {
              if (this.searchText) {
                // Приводим текст для поиска к нижнему регистру
                const searchTextLower = this.searchText.toLowerCase();
                
                // Обнуляем стили всех строк таблиц
                const errorRows = document.querySelectorAll('.error-table tbody tr');
                errorRows.forEach(row => {
                    row.style.backgroundColor = '';
                });
        
                // Ищем ошибку в общем списке ошибок, приводя текст из таблицы к нижнему регистру для сравнения
                const foundErrorRow = [...document.querySelectorAll('.error-table tbody tr')].find(row => {
                    const link = row.querySelector('td:first-child a');
                    if (link) {
                        return link.textContent.toLowerCase().includes(searchTextLower);
                    }
                    return false;
                });
                
                if (foundErrorRow) {
                    foundErrorRow.style.backgroundColor = 'yellow';
                    foundErrorRow.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
            //this.showScrollToTop = true;
            },
            
            /*scrollToTop() {
                
                window.scrollTo({ top: 0, behavior: 'smooth' });
                // После прокрутки вверх скрыть стрелочку
                this.showScrollToTop = false;
               
            },*/
         fillAllErrors() {
               this.fillAllErrors();
                // Заполняем общий массив ошибок при загрузке страницы
                this.errorCodesCategories.forEach(category => {
                    this.allErrors.push(...category.error_codes);
                });
            },
            
            ///dealer/submit-form
        
        submitForm() {
                   // Отправка данных на сервер
                      axios.post('/dealer/submit-form', { email: this.email })
                        .then(response => {
                          alert('Ваша заявка успешно отправлена!');
                          this.email = ''; // Очистка поля почты после отправки
                        })
                        .catch(error => {
                          alert('Произошла ошибка. Пожалуйста, попробуйте еще раз.');
                          console.error(error);
                        });
                    },
            
    
        inputOnKeyPress()
        {
            this.search = '111'
        },
        isGrid() {
            this.design = 'grid'
            localStorage.setItem('design', 'grid');
        },
        isLine() {
            this.design = 'line'
            localStorage.setItem('design', 'line');
        },
        countGoods(n,s1,s2,s3, b = false) {
            let m = n % 10; j = n % 100;
            if(b) {n = n;}
            if(m==0 || m>=5 || (j>=10 && j<=20)) {return s3;}
            if(m>=2 && m<=4) {return s2;}
            return s1;
        },
        sendOrderButton() {
            this.button = 1
        },
        getTotalsumma(digital) {
            var rub = digital.toString().substr(0, String(digital).length-2).replace(/\B(?=(\d{3})+(?!\d))/g, " ");
            var cent = digital.toString().slice(-2);
            return rub+'.'+cent+' ₽';
        },
        priceFormat(digital) { 
            var rub = digital.toString().substr(0, String(digital).length-2)
            var cent = digital.toString().substr(-2)
            var num = rub+'.'+cent
            var result = new Intl.NumberFormat("ru-RU", {
                style: "currency",
                currency: "RUB",
                minimumFractionDigits: 2,
                currencyDisplay: "symbol",
            }).format(num);
            return result
        },
        inCrementOne()
        {
            this.count++
        },
        deCrementOne()
        {
            this.count--
        },
        resultSumma(sum, count)
        {
            var summa = Number.parseInt((sum * 100) / 100).toFixed(2)*Number(count)
            return this.priceFormat(summa)
        },
        inCrement(id) {
            var item = this.card.find(item => item.id === id);
            item.count++;
            item.summa = Number.parseInt((item.price * 100) / 100).toFixed(2)*Number(item.count);
            this.saveCart();
        },
        deCrement(id) {
            var item = this.card.find(item => item.id === id);
            item.count--;
            item.summa = Number.parseInt((item.price * 100) / 100).toFixed(2)*Number(item.count);
            this.saveCart();
        },
        addToOrder(e) {
            var added = JSON.parse(localStorage.getItem('preorder'));
            var arr = added ? added : [added];
            const el = document.querySelector('#preorder'+e);
            const {...order} = el.dataset.order.split(',');
            const add = {
                id: order[0],
                article: order[1],
                name: order[2],
                count: order[3],
                price: order[4]
            }
            console.log('to card: ', add);
            var total = arr.filter(el => el != null).concat(add);
            toastr.success(`Товар "${order[2]}" отправлен в предзаказ`, "Успешно", {
                positionClass:"toast-bottom-left",
                containerId:"toast-bottom-left"
            });
            localStorage.setItem('preorder', JSON.stringify(total));
            this.preorder.push(add);
            this.savePreOrder();
        },
        savePreOrder() {
            const parsed = JSON.stringify(this.preorder);
            localStorage.setItem('preorder', parsed); 
        },
        addToCard(e) {
            var added = JSON.parse(localStorage.getItem('cart'));
            var arr = added ? added : [added];
            const el = document.querySelector('#card'+e);
            // e.target.dataset.card;
            const {...card} = el.dataset.card.split(',');
            const add = {
                id: card[0],
                article: card[1],
                name: card[2],
                category_id: card[3],
                count: card[4],
                price: card[5],
                summa: card[6],
                image: card[7]
            }
            var total = arr.filter(el => el != null).concat(add);
            toastr.success(
                `<a href="/card" class="text-white text-decoration-none">Добавлен в корзину</a>`, 
                `<a href="/card" class="text-white text-decoration-none">Товар "${card[2]}"</a>`, 
                {
                    positionClass:"toast-bottom-left",
                    containerId:"toast-bottom-left"
                });
            localStorage.setItem('cart', JSON.stringify(total));
            this.card.push(add);
            this.saveCart();
        },
        rootsObjectValues(goods) {
            return Object.values(goods).map((value) => ({
                id: value.id,
                article: value.article,
                name: value.name,
                category_id: value.category_id,
                quantity: Number(value.count),
                price: Number(value.price),
                summa: Number(value.summa),
                discount: 0,
                vat: 20,
                assortment: {
                    meta: {
                        href: `https://api.moysklad.ru/api/remap/1.2/entity/product/${value.id}`,
                        //тут поменял ссылку с online.moysklad.ru
                        type: "product",
                        mediaType: "application/json"
                    }
                },
                reserve: 0
                // return Object.values(goods).map((value) => ({
                //     quantity: Number(value.count),
                //     price: Number(value.price),
                //     discount: 0,
                //     vat: 20,
                //     assortment: {
                //         meta: {
                //             href: `https://api.moysklad.ru/api/remap/1.2/entity/product/${value.id}`,//тут поменял ссылку с online.moysklad.ru
                //             type: "product",
                //             mediaType: "application/json"
                //         }
                //     },
                //     reserve: 0
                // }));
            }));
        },
        async Checkout() {
            const roots = this.rootsObjectValues(this.card);
            console.log(this.card);
            var positions = {
                positions: roots
            };
            this.checkout = positions
            localStorage.setItem('checkout', JSON.stringify(positions));
        },
        removeCart(x) {
            this.card.splice(x, 1);
            this.saveCart();
            if(this.card.length === 0) {
                localStorage.removeItem('checkout');
                window.location.assign('/products/mercedes-benz');
            }
        },
        seeData(){
            console.log(this.data);
        },
        saveCart() {
            const parsed = JSON.stringify(this.card);
            localStorage.setItem('cart', parsed); 
        },
        getApproveCookie() {
            this.cookie = false
            localStorage.setItem('cookie', JSON.stringify('false'));
        }
    }
});


var scroll_position = 0;
window.addEventListener('scroll', function () {
    scroll_position = window.scrollY;
    //console.log('scroll position', window.scrollY);
});

const smoothLinks = document.querySelectorAll('a[href^="#"]');
for (let smoothLink of smoothLinks) {
    smoothLink.addEventListener('click', function (e) {
        e.preventDefault();
        const id = smoothLink.getAttribute('href');

        // Check if the href attribute starts with '#'
        if (id.startsWith('#')) {
            // Scroll to the target element
            document.querySelector(id).scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
}


const links = document.querySelectorAll('.nav-link');

for (let link of links) {
    link.addEventListener('click', () => {
        let activeLink = document.querySelector('.nav-link.active');
        if (activeLink) {
            activeLink.classList.remove('active');
        }
        link.classList.add('active');
    })
}


function changeTotal(value) {
    var count = document.getElementById('count');
    var quantity = document.getElementById('quantity');
    var total = document.getElementById('total');
    var remove = document.getElementById('remove');
    count.innerText === total.innerText || count.innerText === 1 ? 
        remove.disabled = true : remove.disabled = false;  
    console.log('summa', summa.innerText );      
    if(value === 'add') {
        count.innerText > 1 ? remove.disabled = true : remove.disabled = false;
        summa.innerText = parseFloat(price.innerText)*(Number(count.innerText)+1);
        total.innerText === count.innerText ? count.innerText = total.innerText : count.innerText++
        quantity.innerText <= 0 ? quantity.innerText = 'больше нет' : quantity.innerText--
    } else {
        summa.innerText = price.innerText === summa.innerText ? 
            price.innerText : 
            summa.innerText-parseFloat(price.innerText);
        
        quantity.innerText <= 0 ? quantity.innerText-- : quantity.innerText++
        count.innerText <= 1 ? count.innerText = 1 : count.innerText--
    } 
}
//summa.innerHTML = parseInt(summa.innerText).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");


let modal = new bootstrap.Modal(document.querySelector('#searchForm'));
let input = document.querySelector('input[type="search"]');



var loadingpage = document.getElementById('loadingpage');
const loaderText = `<button class="btn border-0">
    <span class="spinner-border spinner-border-sm text-danger"></span>
    &#160;Ищем деталь...
</button>`;
function move() {
    var elem = document.getElementById("progressbar");
    document.querySelector('.progress').style.display = 'block';
    var width = 0;
    var id = setInterval(frame, 300);
    function frame() {
        if (width >= 100) {
            clearInterval(id);
        } else {
            width++;
            elem.style.width = width + '%';
        }
    }
}
function loadingPage() {
    // if (document.readyState === "complete") {
    //     console.log('Страница загрузилась');
    // }
    move();
    if(loadingpage) loadingpage.innerHTML = loaderText;
}

document.querySelectorAll('input[list]').forEach( (formfield) => {
    var datalist = document.getElementById(formfield.getAttribute('list'));
    var lastlength = formfield.value.length;
    var checkInputValue = function (inputValue) {
        if (inputValue.length - lastlength > 1) {
            datalist.querySelectorAll('option').forEach( function (item) {
            if (item.value === inputValue) {
                move();
                if(loadingpage) loadingpage.innerHTML = loaderText;
                formfield.form.submit();
            }
            });
        }
        lastlength = inputValue.length;
    };
    formfield.addEventListener('input', function () {
        checkInputValue(this.value);
    }, false);
});


function getResult()
{
    move();
    if(loadingpage) loadingpage.innerHTML = loaderText;
    document.querySelector('#sendForm').submit()
}


//var clearmenu = document.querySelector('.nocontext');
// var contextmenu = document.getElementById('contextmenu');
// var menu = document.getElementById('shop');

// menu.oncontextmenu = function (e) { 
//     e.preventDefault();
//     const res = {
//         position: 'absolute',
//         display: 'block',
//         top: e.clientY+'px',
//         left: e.clientX+'px'
//     }
//     if(e.button === 2){
//         // console.log('res:', `
//         // Screen X/Y: ${e.screenX}, ${e.screenY}
//         // Client X/Y: ${e.clientX}, ${e.clientY}`)
//         contextmenu.style.cssText = Object.entries(res)
//             .map(([k, v]) => k + ':' + v)
//             .join(';');
//     }
//     return false;
// };

// function noPrintMenu()
// {
//     menu.oncontextmenu = function (e) { 
//         return false;
//     }
// }


// document.addEventListener('mouseup', function(e) {
//     contextmenu.style.display = '';
//     if (!menu.contains(e.target)) {
//         //console.log('target:', e.target)
//     }
// });



window.addEventListener('keydown', (e) => {
    if (e.code == 'KeyX' && (e.ctrlKey || e.metaKey)) { //  || e.shiftKey
        modal.hide();
        e.preventDefault();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.code == 'KeyF' && (event.ctrlKey || event.metaKey)) { //  || event.shiftKey
        modal.show();
        event.preventDefault();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.code == 'KeyS' && (event.ctrlKey || event.metaKey)) {
        let confirmAction = confirm('Хотите распечатать страницу ?');
        confirmAction ? window.print() : '';
        event.preventDefault();
    }
});

function isError()
{
    Swal.fire({
        title: 'Материал временно не доступен',
        text: 'Ведутся технические работы.',
        icon: 'warning',
        confirmButtonColor: '#310062',
        confirmButtonText: 'Закрыть'
    })
}

function getReviewYandex()
{
    Swal.fire({
        title: 'Отзыв о товаре',
        html: `Для того чтобы отзывы были достоверными, 
        мы предлагаем отставлять их в "Яндекс.Картах", нам важно ваше мнение.`,
        icon: false,
        showCancelButton: true,
        confirmButtonText: '✎ Написать отзыв',
        cancelButtonText: '✖ Закрыть',
        confirmButtonColor: '#310062',
        cancelButtonColor: '#111',
        allowOutsideClick: false,
        customClass: {
            title: 'text-dark',
            cancelButton: ['d-flex', 'align-items-center', 'gap-2'],
            confirmButton: ['d-flex', 'align-items-center', 'gap-2'],
            htmlContainer: 'text'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.open(
                'https://yandex.ru/profile/8347363005?intent=reviews&utm_source=badge&utm_medium=rating&utm_campaign=v1',
                '_blank'
            );
        }
    });
}

async function isUserSubscribe()
{
    const { value: email } = await Swal.fire({ // dataPro.id
        title: 'Данной запчасти нет в наличии',
        html: `Но она есть у нас на складе. Зарегистрируйтесь, или позвоните нам. 
        <br />
        <a href="tel:+79017331866" class="text-decoration-none fw-bold text-primary">
            +7 (901) 733-18-66
        </a>`,
        //input: 'email',
        //inputPlaceholder: 'Укажите ваш e-mail...',
        showCancelButton: false,
        confirmButtonText: 'Зарегистрироваться',
        cancelButtonText: '✖ Закрыть',
        confirmButtonColor: '#310062',
        cancelButtonColor: '#111',
        allowOutsideClick: false,
        customClass: {
            icon: ['text-danger', 'border-danger'],
            title: 'text-dark',
            cancelButton: ['d-flex', 'align-items-center', 'gap-2'],
            confirmButton: ['d-flex', 'align-items-center', 'gap-2'],
            htmlContainer: 'text'
        }
        // inputValidator: (value) => {
        //     if (!value) {
        //         return 'Неверный адрес электронной почты !'
        //     }
        // }
    });
    // if (email) {
    //     Swal.fire(`Entered email: ${email}`)
    // }
}

function partnerStockEvent()
{
    if(dataPro.id) {
        isLogin()
    } else {
        isNotSignUp()
    } 
}

function isLogin()
{
    Swal.fire({
        icon: 'warning',
        title: 'Товар по предзаказу',
        html: `Данную категорию товаров можно оформить <u class="fw-bold">только по предзаказу</u> в личном кабинете.
        Количество дней ожидания указано в верхнем левом углу карточки товара.
        `,
        showCancelButton: true,
        confirmButtonText: 'В личный кабинет',
        cancelButtonText: '✖ Закрыть',
        confirmButtonColor: '#310062',
        cancelButtonColor: '#111',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.assign('/dashboard/catalog/category/8854033a-48ad-11ed-0a80-0c87007f4175');
        }
    });
}


function loadGoods()
{
    Swal.fire({
        icon: false,
        title: false,
        showConfirmButton: false,
        allowOutsideClick: false,
        html: `
        <div class="d-flex align-items-center gap-3 btn icon-link justify-content-center mt-2">
            <span class="spinner-border spinner-border text-danger"></span>
            <span>Загружаем товар...</span>
        </div>
        `,
    });    
}

function isNotSignUp()
{
    Swal.fire({
        title: 'Товара нет в наличии',
        html: `Вы можете связаться с нашим менеджером чтобы оформить предзаказ, или зарегистрироваться.
        <br /><a href="tel:+79017331866" class="text-decoration-none fw-bold text-primary">+7 (901) 733-18-66</a>`,
        icon: false,
        iconHtml: `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 96 960 960" width="48" height="48">
            <path fill="#dc3545" d="M289.788 976Q260 976 239 954.788q-21-21.213-21-51Q218 874 239.212 853q21.213-21 51-21Q320 832 341 853.212q21 21.213 21 51Q362 934 340.788 955q-21.213 21-51 21Zm404 0Q664 976 643 954.788q-21-21.213-21-51Q622 874 643.212 853q21.213-21 51-21Q724 832 745 853.212q21 21.213 21 51Q766 934 744.788 955q-21.213 21-51 21ZM480 472q-14.45 0-24.225-9.775Q446 452.45 446 438q0-14.45 9.775-24.225Q465.55 404 480 404q14.45 0 24.225 9.775Q514 423.55 514 438q0 14.45-9.775 24.225Q494.45 472 480 472Zm-30-136V136h60v200h-60ZM290 769q-42 0-61.5-34t.5-69l61-111-150-319H62v-60h116l170 364h292l156-280 52 28-153 277q-9.362 16.667-24.681 25.833Q655 600 634 600H334l-62 109h494v60H290Z"/>
        </svg>
        `,
        showCancelButton: true,
        confirmButtonText: '✎ Регистрация',
        cancelButtonText: '✖ Закрыть',
        confirmButtonColor: '#310062', 
        cancelButtonColor: '#111',
        allowOutsideClick: false,
        customClass: {
            icon: ['text-danger', 'border-danger'],
            title: 'text-dark',
            cancelButton: ['d-flex', 'align-items-center', 'gap-2'],
            confirmButton: dataPro.id !== '' ? 'd-none' : ['d-flex', 'align-items-center', 'gap-2'],
            htmlContainer: 'text'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.assign('/signup');
        }
    });
}

function startGoods()
{
    window.location.assign('/products/mercedes-benz');
}

var searchModal = document.getElementById('searchForm')
var searchInput = document.getElementById('search')
searchInput.focus()

searchModal.addEventListener('shown.bs.modal', function () {
    searchInput.focus()
});

function selectOffset() {
    loadGoods();
    var url = document.getElementById("selectOffset").value;
    window.location.assign(url);
}

function selectOffsetBottom() {
    loadGoods();
    var url = document.getElementById("selectOffsetBottom").value;
    window.location.assign(url);
}


[].slice.apply(document.querySelectorAll('img[loading]')).forEach(function(img) {
	img.onerror = function() {
        img.setAttribute('src', '/img/placeholder.png');
	};
});

const log = document.querySelector(".grid-design");
if(log) {
    document.addEventListener("readystatechange", () => {
        if (document.readyState === "complete") {
            log.remove();
        }
    });    
}

function openModal(imgElement) {
        var modal = document.getElementById("myModal");
        var modalImg = document.getElementById("modalImg");

        modal.style.display = "block";
        modalImg.src = imgElement.src;
    }

    function closeModal() {
        var modal = document.getElementById("myModal");
        modal.style.display = "none";
    }
    
    
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));




    // const video = document.getElementById('myVideo');
    // const sources = [
    //   '/img/val.mp4',
    //   '/img/DISK.mp4',
    //   '/img/kolodkiidiski.mp4',
    //   '/img/filtr.mp4'
    // ];
    // let currentSource = 0;
    // // Загрузка следующего видео в скрытый элемент <video>
    // const nextVideo = document.createElement('video');
    // nextVideo.src = sources[(currentSource + 1) % sources.length];
    
    // video.addEventListener('ended', function() {
    //   // Переключение на следующий источник
    //   currentSource = (currentSource + 1) % sources.length;
    //   // Замена источника текущего видео на следующий
    //   video.src = sources[currentSource];
    //   // Подготовка следующего видео к воспроизведению
    //   nextVideo.src = sources[(currentSource + 1) % sources.length];
    //   nextVideo.load();
    //   // Воспроизведение текущего видео
    //   video.play();
    // });


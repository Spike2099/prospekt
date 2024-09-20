<template v-if="cookie !== 'false'">
    <div v-if="cookie" class="w-100 p-3 text-white fixed-bottom" style="z-index: 100;background: #000000db">
        <div class="container">
            <div class="d-flex flex-lg-row flex-column gap-3 gap-lg-0 align-items-center justify-content-between">
                <p class="m-0 text">
                    <small>Мы используем cookie. Это позволяет нам анализировать взаимодействие посетителей 
                    с сайтом и делать его лучше.</small>  
                    <br />Продолжая пользоваться сайтом, вы соглашаетесь 
                    с использованием файлов cookie.
                </p>
                <div>
                    <button class="btn btn-outline-light px-4 py-1" v-on:click="getApproveCookie">Принять</button>
                </div>
            </div>        
        </div>
    </div>    
</template>
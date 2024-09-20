@extends('layout/main')
@section('title', 'Промо-материалы')
@section('breadcrumbs')
<div class="d-flex gap-2 mb-2">
    <a href="/dashboard" class="text-muted">Панель</a>   
    <span class="text-secondary">/</span>
    <span class="text-muted">Промо-материалы</span>    
</div>
@endsection
@section('content')  
<h6 class="text-muted">Список каталогов партнёров</h6>
<div class="row">
    <div class="col">
        <template v-if="edit">
            <div class="card border-0 shadow-sm mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h2></h2>
                    <button class="btn" v-on:click="viewPromo(array.stock)">
                        <x-icon-close />
                    </button>                        
                </div>                
                <form class="card-body" @submit.prevent="onEditSubmit">
                    <div class="d-grid gap-2">
                        <label class="btn">
                            <figure class="position-relative" v-if="array.banner && promo.preview.src == ''">
                                <div class="position-absolute badge text-bg-dark">заменить</div>
                                <img :src="array.banner" :alt="array.brand" class="w-50" />
                            </figure>  

                            <span v-if="promo.preview.src == ''" class="btn btn-dark px-4 icon-link">
                                <x-icon-download /> 
                                Выберите картинку на баннер
                            </span>
                            <figure class="position-relative" v-else>
                                <div class="position-absolute badge text-bg-dark">заменить</div>
                                <img :src="promo.preview.src" :alt="promo.preview.name" class="w-50" />
                                <figcaption class="border-top mx-auto p-2 w-50">
                                    @{{ `${promo.preview.name} / ${promo.preview.size}` }}
                                </figcaption>
                            </figure>
                            <input type="file" name="banner" class="d-none" @change="handleFileSelect($event)" accept="image/png, image/jpeg" />
                        </label>
                        <input type="text" name="header" :value="array.header" class="form-control fw-bold" placeholder="Заголовок" />   
                        <input type="text" name="brand" :value="array.brand" class="form-control" placeholder="Бренд" />   
                        <input type="text" name="uuid" :value="array.stock" class="form-control" placeholder="uuid" />   
                        <textarea id="promoedit" name="description">
                            @{{array.description}}
                        </textarea> 
                        <label class="d-flex align-items-center g-2">
                            <x-icon-pdf size="80px" />
                            <span class="fw-bold mb-4" v-if="promo.preview.pdf.name == ''">
                                @{{array.pdf ? array.pdf.split('/').at(-1) : 'Прикрепите PDF файл c презентацией'}}
                            </span>
                            <span class="mb-4" v-else>
                                <strong>@{{promo.preview.pdf.name}}</strong> / @{{promo.preview.pdf.size}}
                            </span>
                            <input type="file" name="pdf" class="d-none" @change="FilePDF($event)" accept="application/pdf" />  
                        </label>
                    </div>
                    <hr />
                    <button class="btn btn-dark px-4 icon-link">
                        <x-icon-check /> Сохранить
                    </button>
                </form>
            </div>
        </template>
        <template v-else>
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <form class="d-flex gap-2" @submit.prevent="onSubmit">
                        <input 
                            type="text" 
                            placeholder="Название бренда" 
                            v-model="brand" 
                            class="form-control" 
                            :class="[isError.error ? 'text-danger border-danger' : '']"
                        />
                        <input type="text" placeholder="Заголовок..." v-model="header" class="form-control" />
                        <div class="d-grid w-50">
                            <button class="btn btn-dark px-4 icon-link" v-if="loading == true">
                                <x-icon-add /> Cоздать
                            </button>
                            <button class="btn btn-dark px-4" v-else>Запись...</button>                    
                        </div>
                    </form>
                    <small class="text-danger" v-if="isError.error">@{{isError.error}}</small>
                </div>
                {{-- <pre v-html="JSON.parse(JSON.stringify(isError, null, 4))"></pre> --}}
            </div>
            {{-- <pre v-html="JSON.stringify(result, null, 4)"></pre> --}}
            <div v-if="loading === false">
                <div class="card border-0 shadow-sm mb-3 placeholder-glow"><div class="card-body placeholder rounded px-3 h2 m-0">Loading</div></div>
                <div class="card border-0 shadow-sm mb-3 placeholder-glow"><div class="card-body placeholder rounded px-3 h2 m-0">Loading</div></div>
                <div class="card border-0 shadow-sm mb-3 placeholder-glow"><div class="card-body placeholder rounded px-3 h2 m-0">Loading</div></div>
            </div>
            <template v-if="result.length !== 0">
                <div class="card border-0 shadow-sm mb-3" v-for="(item, id) in result" :key="item.id">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <a :href="`/dashboard/admin/promo/${item.brand}`" class="link-body-emphasis text-body-emphasis px-3 fw-bold text-truncate w-50">
                                @{{item.header}}
                            </a>
                            <div class="d-flex align-items-center gap-2">
                                <div class="btn btn-sm fst-italic text-body-secondary">@{{new Date(item.created_at).toLocaleString()}}</div>
                                <button class="btn bg-dark-subtle material-symbols-outlined" v-on:click="viewPromo(item.stock)">edit_note</button>
                                <button class="btn text-danger bg-danger-subtle" v-on:click="deletePromo(item.stock)">
                                    <x-icon-delete size="25px" />
                                </button> 
                            </div>
                        </div>
                    </div>
                </div>
            </template>             
		</template>
    </div>
</div>
@endsection
<div class="modal fade" id="subscription" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header border-0 pb-0">
                <h1 class="modal-title fs-5 text" id="subscription">Оформление подписки</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2 text-secondary">
                    Если у нас по какой-то причине не оказалось нужной вам запчасти, 
                    вы можете <u>подписаться</u>, и мы <b>пришлём</b> вам актуальную 
                    информацию по ожидаймой позиции.
                </div>
                <div class="mb-2">
                    <input type="email" class="form-control" placeholder="Ваш e-mail" />
                </div>
                <div>
                    <textarea name="message" class="form-control" rows="3" placeholder="Список запчастей..."></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light text px-4" data-bs-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary text px-4 d-flex gap-2">
                    <x-icon-mark-email-read color="#fff" />
                    <span>Подписаться</span> 
                </button>
            </div>
        </div>
    </div>
</div>
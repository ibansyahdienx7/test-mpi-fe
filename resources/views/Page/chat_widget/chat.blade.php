<div id='whatsapp-chat' class='hides'>
    <div class='header-chat'>
        <div class='head-home'>
            <div class='info-avatar'>
                <img src='{{config('app.url') . '/assets/template/assets/img/iban.png'}}' alt="{{config('app.brand_company')}}" title="{{config('app.brand_company')}}" />
            </div>
            <p>
                <span class="whatsapp-name">
                    {{config('app.brand_company')}}
                    <i class='bx bxs-badge-check text-success-light' ></i>
                </span>
                <br>
                <small>
                    <div id="statusCek"></div>
                </small>
            </p>
        </div>
        <div class='get-new hide'>
            <div id='get-label'></div>
            <div id='get-nama'></div>
        </div>
    </div>
    <div class='home-chat'></div>
    <div class='start-chat'>
        <div pattern="https://elfsight.com/assets/chats/patterns/whatsapp.png" class="WhatsappChat__Component-sc-1wqac52-0 whatsapp-chat-body">
            <div class="WhatsappChat__MessageContainer-sc-1wqac52-1 dAbFpq">
                <div style="opacity: 0;" class="WhatsappDots__Component-pks5bf-0 eJJEeC">
                    <div class="WhatsappDots__ComponentInner-pks5bf-1 hFENyl">
                        <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotOne-pks5bf-3 ixsrax"></div>
                        <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotTwo-pks5bf-4 dRvxoz"></div>
                        <div class="WhatsappDots__Dot-pks5bf-2 WhatsappDots__DotThree-pks5bf-5 kXBtNt"></div>
                    </div>
                </div>
                <div style="opacity: 1;" class="WhatsappChat__Message-sc-1wqac52-4 kAZgZq">
                    <div class="WhatsappChat__Author-sc-1wqac52-3 bMIBDo">{{config('app.brand_company')}}</div>
                    <div class="WhatsappChat__Text-sc-1wqac52-2 iSpIQi">{{ __('messages.hi_there') }} 👋<br>{{ __('messages.chat_desc2') }}</div>
                    <div class="WhatsappChat__Time-sc-1wqac52-5 cqCDVm">{{date('H:i')}}</div>
                </div>
            </div>
        </div>

        <div class='blanter-msg'>
            <textarea id='chat-input' placeholder='Message' maxlength='120' row='1'></textarea>
            <a href='javascript:void(0);' id='send-it'>
                <svg viewBox="0 0 448 448">
                    <path d="M.213 32L0 181.333 320 224 0 266.667.213 416 448 224z"/>
                </svg>
            </a>
        </div>
    </div>
    <div id='get-number'></div>
    <a class='close-chat' href='javascript:void(0);'>×</a>
</div>

<!-- WIDGET -->
<a class="blantershow-chats" href="javascript:void(0);" title="Show Chat">
    <svg width="20" viewBox="0 0 24 24">
        <defs/>
        <path fill="#eceff1" d="M20.5 3.4A12.1 12.1 0 0012 0 12 12 0 001.7 17.8L0 24l6.3-1.7c2.8 1.5 5 1.4 5.8 1.5a12 12 0 008.4-20.3z"/>
        <path fill="#4caf50" d="M12 21.8c-3.1 0-5.2-1.6-5.4-1.6l-3.7 1 1-3.7-.3-.4A9.9 9.9 0 012.1 12a10 10 0 0117-7 9.9 9.9 0 01-7 16.9z"/>
        <path fill="#fafafa" d="M17.5 14.3c-.3 0-1.8-.8-2-.9-.7-.2-.5 0-1.7 1.3-.1.2-.3.2-.6.1s-1.3-.5-2.4-1.5a9 9 0 01-1.7-2c-.3-.6.4-.6 1-1.7l-.1-.5-1-2.2c-.2-.6-.4-.5-.6-.5-.6 0-1 0-1.4.3-1.6 1.8-1.2 3.6.2 5.6 2.7 3.5 4.2 4.2 6.8 5 .7.3 1.4.3 1.9.2.6 0 1.7-.7 2-1.4.3-.7.3-1.3.2-1.4-.1-.2-.3-.3-.6-.4z"/>
    </svg>
    Chat
</a>

<script type="text/javascript">
    // =========================================== CHAT WIDGET ============================================== //
    /* Whatsapp Chat Widget by www.bloggermix.com */
    $(document).on("click", "#send-it", function() {
        var a = document.getElementById("chat-input");
        if ("" != a.value) {
            var b = $("#get-number").text(),
            c = document.getElementById("chat-input").value,
            d = "https://web.whatsapp.com/send",
            e = b,
            f = "&text=Hallo%20*Iban%20Syahdien%20Akbar*,%0A%0A" + c + '%0A%0APowered%20by%20*Iban%20Syahdien%20Akbar';
            if (
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
                navigator.userAgent
            )
            )
            var d = "whatsapp://send";
            var g = d + "?phone=+6281293820960" + e + f;
            window.open(g, "_blank");

            $('#chat-input').val('');
            $('#chat-input').attr('placeholder', 'Message');
        }
    }),
    $(document).on("click", ".informasi", function() {
        (document.getElementById("get-number").innerHTML = $(this)
        .children(".my-number")
        .text()),
        $(".start-chat,.get-new")
            .addClass("shows")
            .removeClass("hides"),
        $(".home-chat,.head-home")
            .addClass("hides")
            .removeClass("shows"),
        (document.getElementById("get-nama").innerHTML = $(this)
            .children(".info-chat")
            .children(".chat-nama")
            .text()),
        (document.getElementById("get-label").innerHTML = $(this)
            .children(".info-chat")
            .children(".chat-label")
            .text());
    }),
    $(document).on("click", ".close-chat", function() {
        $("#whatsapp-chat")
        .addClass("hides")
        .removeClass("shows");

        $('#chat-input').val('');
        $('#chat-input').attr('placeholder', 'Message');

    }),
    $(document).on("click", ".blantershow-chats", function() {
        $("#whatsapp-chat")
        .addClass("shows")
        .removeClass("hides");
    });
</script>

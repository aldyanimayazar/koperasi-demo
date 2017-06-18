<script type="text/javascript">
    $(document).ready(function () {
        if(window.location.href.indexOf("member") > -1) {
            $('#dashboard').removeClass("active");
            $('#addMember').removeClass("active");
            $("#keanggotaan").attr("aria-expanded","true");
            $("#keanggotaan").attr('class', 'active');
            $("#subPages").attr('class', 'collapse in');
            $("#listMember").attr('class', 'active');
        }

        if(window.location.href.indexOf("member/create") > -1) {
            $('#dashboard').removeClass("active");
            $('#listMember').removeClass("active");
            $("#keanggotaan").attr("aria-expanded","true");
            $("#keanggotaan").attr('class', 'active');
            $("#subPages").attr('class', 'collapse in');
            $("#addMember").attr('class', 'active');
        }

        if(window.location.href.indexOf("transaction/saving") > -1) {
            $('#dashboard').removeClass("active");
            $("#transaction").attr("aria-expanded","true");
            $("#transaction").attr('class', 'active');
            $("#subPages-transaction").attr('class', 'collapse in');
            $("#transaction-save").attr('class', 'active');
        }

        if(window.location.href.indexOf("transaction/loan") > -1) {
            $('#dashboard').removeClass("active");
            $("#transaction").attr("aria-expanded","true");
            $("#transaction").attr('class', 'active');
            $("#subPages-transaction").attr('class', 'collapse in');
            $("#transaction-loan").attr('class', 'active');
        }

        if(window.location.href.indexOf("transaction/withdraw") > -1) {
            $('#dashboard').removeClass("active");
            $("#transaction").attr("aria-expanded","true");
            $("#transaction").attr('class', 'active');
            $("#subPages-transaction").attr('class', 'collapse in');
            $("#transaction-withdraw").attr('class', 'active');
        }

        if(window.location.href.indexOf("installment-payment") > -1) {
            $('#dashboard').removeClass("active");
            $("#transaction").attr("aria-expanded","true");
            $("#transaction").attr('class', 'active');
            $("#subPages-transaction").attr('class', 'collapse in');
            $("#transaction-installment-payment").attr('class', 'active');
        }
    });

    var session_context = "{{ session('context') }}";
    var session_message = "{{ session('message') }}";
    if (session_message != '') {
        showNotifications(session_context, session_message);
    }

    if ("{{ count($errors) > 0 }}") {
        messages = '<ul>'+
            @foreach ($errors->all() as $error)
                '<li>{{ $error }}</li>'+
            @endforeach
        '</ul>';
        showNotifications('error', messages);
    }

    function showNotifications(context, message) {
        $context = context;
        $message = message;

        if($context == '') {
            $context = 'info';
        }

        toastr.remove();
        toastr[$context]($message, $context);
    }
</script>

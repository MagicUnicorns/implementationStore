<template>
    <div class="response-container">
        <div class="header">
            <h2>Response</h2>
        </div>
        <p>The <b>response</b> from the <code>/payments</code> endpoint will be shown here.</p>
        <pre class="response-code" id="response-code"></pre>
    </div>

</template>

<script>
    export default {
        props: ['userId'],
        mounted() {
            console.log('PaymentsResponseComponent mounted, user id = ' + this.userId + '.')
            Echo.private('App.Models.User.' + this.userId)
                .listen('TestNotification', (message) => {
                    console.log("message is here (response component):");
                    console.log(message);
                })
                .listen('PaymentResponseNotification', (message) => {
                    console.log("PaymentResponseNotification is here: ");
                    console.log(message);
                    document.getElementById('response-code').innerHTML = JSON.stringify(JSON.parse(message.message),null,4);
                });
        }
    }
</script>

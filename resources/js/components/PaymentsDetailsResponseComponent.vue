<template>
    <div class="response-container">
        <div class="header">
            <h2>Details</h2>
        </div>
        <p>The <b>response</b> from the <code>/payments/details</code> endpoint will be shown here.</p>
        <pre class="payments-details-response-code" id="payments-details-response-code"></pre>
    </div>

</template>

<script>
    export default {
        props: ['userId'],
        mounted() {
            console.log('PaymentsDetailsResponseComponent mounted, user id = ' + this.userId + '.')
            Echo.private('App.Models.User.' + this.userId)
                .listen('TestNotification', (message) => {
                    console.log("message is here (details component):");
                    console.log(message);
                })
                .listen('PaymentDetailsResponseNotification', (message) => {
                    console.log("PaymentDetailsResponseNotification is here: ");
                    console.log(message);
                    document.getElementById('payments-details-response-code').innerHTML = JSON.stringify(JSON.parse(message.message),null,4);
                });
        }
    }
</script>

<template>
    <div class="webhook-container">
        <!-- <pre class="webhook-code" id="webhook-code"></pre> -->
        <div class="accordion" id="webhookAccordion">
            <!-- Will be filled from Websockets (see script part below) -->
        </div>
    </div>

</template>

<script>
    export default {
        props: ['userId'],
        mounted() {
            console.log('WebhooksComponent mounted, user id = ' + this.userId + '.')

            var counter = 0;

            Echo.private('App.Models.User.' + this.userId)
                .listen('TestNotification', (message) => {
                    console.log("message is here (webhook component):");
                    console.log(message);
                })
                .listen('WebhookNotification', (message) => {
                    console.log("WebhookNotification is here: ");
                    console.log(message);

                    var uniqueId = Date.now();

                    var template = `<div class ="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#${uniqueId}" aria-expanded="true" aria-controls="${uniqueId}">
                            Webhook ${++counter}
                        </button>
                        </h2>
                        <div id="${uniqueId}" class="accordion-collapse collapse" aria-labelledby="${uniqueId}" data-bs-parent="#webhookAccordion">
                            <div class="accordion-body">
                                ${JSON.stringify(JSON.parse(message.message),null,4)}
                            </div>
                        </div>
                    </div>`;

                    document.getElementById("webhookAccordion").insertAdjacentHTML("beforeend", template);
                });
        }
    }
</script>

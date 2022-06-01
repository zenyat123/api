

<x-app-layout>

    <x-slot name="header">

        <h2 class = "font-semibold text-xl text-gray-800 leading-tight">Tokens</h2>

    </x-slot>

    <div id = "app">

        <x-container class="py-8">

            <x-form-section>

                <x-slot name="title">Formulario de ingreso</x-slot>

                <x-slot name="description">Generar access tokens</x-slot>

                <div class = "grid grid-cols-6 gap-6">

                    <div class = "col-span-6 sm:col-span-4">

                        <div>

                            <x-label>Nombre</x-label>

                            <x-input type="text" v-model="form.name" class="w-full mt-1"/>

                        </div>

                        <div v-if = "form.errors.length > 0" class = "bg-red-100 border border-red-400 text-red-700 rounded px-4 py-3 mt-4">

                            <strong>¡Aviso!</strong>

                            <ul>

                                <li v-for = "error in form.errors">@{{ error }}</li>

                            </ul>

                        </div>

                    </div>

                </div>

                <x-slot name="actions">

                    <x-button v-on:click="save" v-bind:disabled="form.disabled">Generar</x-button>

                </x-slot>

            </x-form-section>

            <x-form-section class="mt-12" v-if="tokens.length > 0">

                <x-slot name="title">Lista de access tokens</x-slot>

                <x-slot name="description">Generados por el momento</x-slot>

                <div>

                    <table class = "text-gray-600">

                        <thead class = "border-b border-gray-300">

                            <th class = "w-full py-2">Nombre</th>

                            <th class = "py-2">Acciones</th>

                        </thead>

                        <tbody class = "divide-y divide-gray-300">

                            <tr v-for = "token in tokens">

                                <td class = "py-2">@{{ token.name }}</td>

                                <td class = "flex divide-x divide-gray-300 py-2">

                                    <a v-on:click = "show(token)" class = "cursor-pointer font-semibold hover:text-green-600 pr-2">Ver</a>

                                    <a v-on:click = "revoke(token)" class = "cursor-pointer font-semibold hover:text-red-600 pl-2">Anular</a>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </x-form-section>

            <x-dialog-modal modal="showToken.open">

                <x-slot name="title">Token</x-slot>

                <x-slot name="content">

                    <div class = "space-y-2 overflow-auto">

                        <p>

                            <span class = "font-semibold">Access Token:</span>
                            <span v-text = "showToken.id"></span>

                        </p>

                        <p>

                            <span class = "font-semibold">Validez: </span>
                            <span v-text = "showToken.expires_at"></span>

                        </p>

                    </div>

                </x-slot>

                <x-slot name="footer">

                    <button v-on:click="showToken.open = false" class = "inline-flex justify-center bg-white border border-gray-300 rounded-md font-medium text-base text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full px-4 py-2 sm:w-auto sm:text-sm sm:mt-0 sm:ml-3">Aceptar</button>

                </x-slot>

            </x-dialog-modal>

        </x-container>

    </div>

    @push("vue")

    <script>

        new Vue({

            el: '#app',

            data: {

                tokens: [],
                form: {
                    name: '',
                    errors: [],
                    disabled: false
                },
                showToken: {
                    open: false,
                    id: '',
                    expires_at: ''
                }

            },

            mounted() {

                this.getTokens();

            },

            methods: {

                getTokens(){
                    axios.get('/oauth/personal-access-tokens')
                        .then(response => {
                            this.tokens = response.data;
                        });
                },

                show(token) {

                    this.showToken.open = true;
                    this.showToken.id = token.id;
                    this.showToken.expires_at = token.expires_at;

                },

                save() {

                    this.form.disabled = true;

                    axios.post('/oauth/personal-access-tokens', this.form)
                        .then(response => {

                            this.form.name = '';
                            this.form.errors = [];
                            this.form.disabled = false;

                        })
                        .catch(error => {
                            this.form.errors = _.flatten(_.toArray(error.response.data.errors));
                            this.form.disabled = false;
                        });

                },

                revoke(token){

                    axios.delete('/oauth/personal-access-tokens/' + token.id)
                        .then(response => {
                            this.getTokens();
                        });

                }

            }

        });

    </script>

    @endpush

</x-app-layout>


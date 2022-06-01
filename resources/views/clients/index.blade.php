

<x-app-layout>

    <x-slot name="header">

        <h2 class = "font-semibold text-xl text-gray-800 leading-tight">Clientes</h2>

    </x-slot>

    <div id = "app">

        <x-container class="py-8">

            <x-form-section>

                <x-slot name="title">Agregar cliente</x-slot>

                <x-slot name="description">Ingresar los campos solicitados</x-slot>

                <div class = "grid grid-cols-6 gap-6">

                    <div class = "col-span-6 sm:col-span-4">

                        <x-label>Nombre</x-label>

                        <x-input type="text" v-model="createForm.name" class="w-full mt-1"/>

                    </div>

                    <div class = "col-span-6 sm:col-span-4">

                        <x-label>Url de redirección</x-label>

                        <x-input type="text" v-model="createForm.redirect" class="w-full mt-1"/>

                        <div v-if = "createForm.errors.length > 0" class = "bg-red-100 border border-red-400 text-red-700 rounded px-4 py-3 mt-4">

                            <strong>¡Aviso!</strong>

                            <ul>

                                <li v-for = "error in createForm.errors">@{{ error }}</li>

                            </ul>

                        </div>

                    </div>

                </div>

                <x-slot name="actions">

                    <x-button v-on:click="save" v-bind:disabled="createForm.disabled">Agregar</x-button>

                </x-slot>

            </x-form-section>

            <x-form-section class="mt-12" v-if="clients.length > 0">

                <x-slot name="title">Lista de clientes</x-slot>

                <x-slot name="description">Agregados actualmente junto a sus acciones</x-slot>

                <div>

                    <table class = "text-gray-600">

                        <thead class = "border-b border-gray-300">

                            <th class = "w-full py-2">Nombre</th>

                            <th class = "py-2">Acciones</th>

                        </thead>

                        <tbody class = "divide-y divide-gray-300">

                            <tr v-for = "client in clients">

                                <td class = "py-2">@{{ client.name }}</td>

                                <td class = "flex divide-x divide-gray-300 py-2">

                                    <a v-on:click = "show(client)" class = "cursor-pointer font-semibold hover:text-green-600 pr-2">Ver</a>

                                    <a v-on:click = "edit(client)" class = "cursor-pointer font-semibold hover:text-blue-600 px-2">Editar</a>

                                    <a v-on:click = "destroy(client)" class = "cursor-pointer font-semibold hover:text-red-600 pl-2">Eliminar</a>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </x-form-section>

        </x-container>

        <x-dialog-modal modal="showClient.open">

            <x-slot name="title">Credenciales</x-slot>

            <x-slot name="content">

                <div class = "space-y-2">

                    <p>

                        <span class = "font-semibold">CLIENTE: </span>
                        <span v-text = "showClient.name"></span>

                    </p>

                    <p>

                        <span class = "font-semibold">CLIENT_ID: </span>
                        <span v-text = "showClient.id"></span>

                    </p>

                    <p>

                        <span class = "font-semibold">CLIENT_SECRET: </span>
                        <span v-text = "showClient.secret"></span>

                    </p>

                </div>

            </x-slot>

            <x-slot name="footer">

                <button v-on:click="showClient.open = false" class="inline-flex justify-center bg-white border border-gray-300 rounded-md font-medium text-base text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full px-4 py-2 sm:w-auto sm:text-sm sm:mt-0 sm:ml-3">
                    Aceptar
                </button>

            </x-slot>

        </x-dialog-modal>

        <x-dialog-modal modal="editForm.open">

            <x-slot name="title">Editar cliente</x-slot>

            <x-slot name="content">

                <div class = "space-y-6">

                    <div>

                        <x-label>Nombre</x-label>

                        <x-input type="text" v-model="editForm.name" class="w-full mt-1"/>

                    </div>

                    <div>

                        <x-label>Url de redirrección</x-label>

                        <x-input type="text" v-model="editForm.redirect" class="w-full mt-1"/>

                    </div>

                </div>

                <div v-if = "editForm.errors.length > 0" class = "bg-red-100 border border-red-400 text-red-700 rounded px-4 py-3 mt-4">

                    <span class = "font-bold">¡Aviso!</span>

                    <ul>

                        <li v-for = "error in editForm.errors">@{{ error }}</li>

                    </ul>

                </div>

            </x-slot>

            <x-slot name="footer">

                <button
                    v-on:click="update()"
                    v-bind:disabled="editForm.disabled"
                    class="inline-flex justify-center bg-gray-800 border border-transparent rounded-md font-medium text-base text-white hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 w-full px-4 py-2 mb-3 sm:w-auto sm:text-sm sm:mt-0 sm:ml-3 sm:mb-0">
                    Editar
                </button>

                <button v-on:click="editForm.open = false"
                    class="inline-flex justify-center bg-white border border-gray-300 rounded-md font-medium text-base text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full px-4 py-2 sm:w-auto sm:text-sm sm:mt-0 sm:ml-3">
                    Cancelar
                </button>

            </x-slot>

        </x-dialog-modal>

    </div>

    @push("vue")

    <script>

        new Vue({

            el: '#app',

            data: {

                clients: [],
                showClient: {
                    open: false,
                    name: null,
                    id: null,
                    secret: null
                },
                createForm: {
                    name: null,
                    redirect: null,
                    disabled: false,
                    errors: []
                },
                editForm: {
                    open: false,
                    id: null,
                    name: null,
                    redirect: null,
                    disabled: false,
                    errors: []
                }

            },

            mounted() {

                this.getClients();

            },

            methods: {

                getClients() {

                    axios.get('/oauth/clients')
                        .then(response => {
                            this.clients = response.data;
                        });

                },

                show(client) {

                    this.showClient.open = true;
                    this.showClient.name = client.name;
                    this.showClient.id = client.id;
                    this.showClient.secret = client.secret;

                },

                save() {

                    this.createForm.disabled = true;

                    axios.post('/oauth/clients', this.createForm)
                        .then(response => {

                            this.createForm.name = null;
                            this.createForm.redirect = null;
                            this.createForm.errors = [];

                            this.getClients();

                            this.createForm.disabled = false;

                        }).catch(error => {

                            this.createForm.errors = _.flatten(_.toArray(error.response.data.errors));

                            this.createForm.disabled = false;

                        });

                },

                edit(client) {

                    this.editForm.open = true;
                    this.editForm.errors = [];

                    this.editForm.id = client.id;
                    this.editForm.name = client.name;
                    this.editForm.redirect = client.redirect;

                },

                update() {

                    this.editForm.disabled = true;

                    axios.put('/oauth/clients/' + this.editForm.id, this.editForm)
                        .then(response => {

                            this.editForm.open = false;
                            this.editForm.name = null;
                            this.editForm.redirect = null;
                            this.editForm.disabled = false;
                            this.editForm.errors = [];

                            this.getClients();


                        }).catch(error => {

                            this.editForm.errors = _.flatten(_.toArray(error.response.data.errors));

                            this.editForm.disabled = false;

                        });

                },

                destroy(client) {

                    axios.delete('/oauth/clients/' + client.id)
                        .then(response => {
                            this.getClients();
                        });

                }

            }

        });

    </script>

    @endpush

</x-app-layout>


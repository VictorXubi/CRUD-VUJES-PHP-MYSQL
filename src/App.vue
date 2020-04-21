<template>
    <div id="app">
        <p>{{ mensaje }}</p>
        <label for="busqueda">Busqueda </label>
        <input type="text" name="busqueda" id="busqueda" v-on:keyup="busquedaPorDescripcion" v-model="busqueda.teclas" />

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Nuevo
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Departamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="CodDepartamento">Codigo </label>
                        <input type="text" name="CodDepartamento" id="CodDepartamento" /> <br />
                        <div class="alert alert-dismissible alert-warning" v-if="errorCodigoRepetido">
                            <p>EL codigo ya esta en la base de datos</p>
                        </div>
                        <label for="DescDepartamento">Descripcion </label>
                        <input type="text" name="DescDepartamento" id="DescDepartamento" /> <br />
                        <label for="VolumenNegocio">Volumen de negocio </label>
                        <input type="number" name="VolumenNegocio" id="VolumenNegocio" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button @click="nuevoDepartamento()" type="button" class="btn btn-primary">Crear</button>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Codigo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Volumen</th>
                    <th scope="col">Operaciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for=" d in arrayDepartamentos">
                    <th>{{ d.CodDepartamento }}</th>
                    <td>{{ d.DescDepartamento }}</td>
                    <td>{{ d.VolumenNegocio }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2" @click="elegirDepartamento(d)">
                            Editar
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal3" @click="elegirDepartamento(d)">
                            Eliminar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Editar Departamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="eCodDepartamento">Codigo </label>
                        <input type="text" name="eCodDepartamento" id="eCodDepartamento" v-model="departamento.CodDepartamento" disabled /> <br />
                        <label for="eDescDepartamento">Descripcion </label>
                        <input type="text" name="eDescDepartamento" id="eDescDepartamento" v-model.lazy="departamento.DescDepartamento" /> <br />
                        <label for="eVolumenNegocio">Volumen de negocio </label>
                        <input type="number" name="eVolumenNegocio" id="eVolumenNegocio" v-model.lazy="departamento.VolumenNegocio" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button @click="editarDepartamento()" type="button" class="btn btn-primary">Editar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel2">Editar Departamento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="eCodDepartamento">Codigo </label>
                        <input type="text" name="bCodDepartamento" id="bCodDepartamento" v-model="departamento.CodDepartamento" disabled /> <br />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button @click="eliminarDepartamento()" type="button" class="btn btn-primary">Borrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Axios from "axios";

    export default {
        name: 'app',
        data() {
            return {
                mensaje: 'Prueba de mensaje',
                arrayDepartamentos: [],
                departamento: {},
                busqueda: { teclas: '' },
                errorCodigoRepetido: ''
            }
        },
        mounted() {
            this.mostrarDatos()
        },
        methods: {
            mostrarDatos: function () {
                Axios.get("http://localhost/Api/api.php?accion=mostrar")
                    .then(response => (this.arrayDepartamentos = response.data.departamentos))
            },
            busquedaPorDescripcion: function () {
                let formData = new FormData()

                formData.append("busqueda", document.getElementById("busqueda").value)

                Axios.post("http://localhost/Api/api.php?accion=buscar", formData)
                    .then(response => (this.arrayDepartamentos = response.data.departamentos))
                //.then(function (response) {
                //    console.log(response)
                //})
            },
            nuevoDepartamento: function () {

                let formData = new FormData()

                formData.append("CodDepartamento", document.getElementById("CodDepartamento").value)
                formData.append("DescDepartamento", document.getElementById("DescDepartamento").value)
                formData.append("VolumenNegocio", document.getElementById("VolumenNegocio").value)
                Axios.post("http://localhost/Api/api.php?accion=insertar", formData)
                    .then(response => (this.errorCodigoRepetido = response.data.error))
                this.mostrarDatos()
                
            },
            editarDepartamento: function () {

                let formData = new FormData()

                formData.append("eCodDepartamento", document.getElementById("eCodDepartamento").value)
                formData.append("eDescDepartamento", document.getElementById("eDescDepartamento").value)
                formData.append("eVolumenNegocio", document.getElementById("eVolumenNegocio").value)

                Axios.post("http://localhost/Api/api.php?accion=editar", formData)
                    .then(function (response) {
                        console.log(response)
                    })
                this.mostrarDatos()
            },
            eliminarDepartamento: function () {

                let formData = new FormData()

                formData.append("bCodDepartamento", document.getElementById("bCodDepartamento").value)

                Axios.post("http://localhost/Api/api.php?accion=eliminar", formData)
                    .then(function (response) {
                        console.log(response)
                    })
                this.mostrarDatos()
            },
            elegirDepartamento(d) {
                this.departamento = d
                console.log(this.departamento)
            }
        }
    };
</script>

<style>
</style>

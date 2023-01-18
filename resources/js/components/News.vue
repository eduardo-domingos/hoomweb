<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Busca de Notícias</div>
                    <form>
                        <div class="card-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="inputId" class="form-label">ID</label>
                                    <input type="number" class="form-control" id="inputId" aria-describedby="idHelp" placeholder="ID">
                                    <div id="idHelp" class="form-text">Opcional. Informe o ID do registro</div>
                                </div>
                                <div class="col mb-3">
                                    <label for="inputTitle" class="form-label">Título</label>
                                    <input type="text" class="form-control" id="inputTitle" aria-describedby="tituloHelp" placeholder="Título">
                                    <div id="tituloHelp" class="form-text">Opcional. Informe título da notícia</div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="card-footer d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary me-md-2">Pesquisar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

</script>

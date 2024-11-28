async function iniciar() {
}

async function importarRacasAPI() {
    var url = `php/cachorro_importar.php`; 
    try {
        var res = await fetch(url);
        var resultado = await res.text(); 
        console.log(resultado);
        alert(resultado); 
    } catch (error) {
        console.error("Erro ao importar dados da API:", error);
        alert("Erro ao importar raças da API.");
    }
    listarCachorros();
}


async function listarCachorros() {
    var url = `php/cachorro_listar.php`;
    var res = await fetch(url).then(resposta => resposta.json());
    console.log(res);

    var tabela = document.getElementById('tabelaCachorro');
    var a = '';
    for (var i = 0; i < res.length; i++) {
        a += `<tr>
                <td>${res[i].id}</td>
                <td>${res[i].name}</td>
                <td>${res[i].origin || "Desconhecida"}</td>
                <td>${res[i].temperament || "Desconhecido"}</td>
                <td>${res[i].lifespan || "Não informado"}</td>
                <td>
                    <button class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#modalCachorro"
                        onclick="abrirCachorro(${res[i].id})">Alterar</button>
                </td>
                <td>
                    <button class="btn btn-danger" onclick="excluirCachorro(${res[i].id})">Excluir</button>
                </td>
            </tr>`;
    }
    tabela.innerHTML = a;
}

async function abrirCachorro(id) {
    var inputId = document.getElementById('idCachorro');
    var inputNome = document.getElementById('nomeCachorro');
    var inputOrigem = document.getElementById('origemCachorro');
    var inputTemperamento = document.getElementById('temperamentoCachorro');
    var inputLifespan = document.getElementById('lifespanCachorro');

    if (id === 0) {
        document.getElementById('tituloCachorro').innerHTML = `Inserindo nova raça`;

        inputId.value = '';
        inputNome.value = '';
        inputOrigem.value = '';
        inputTemperamento.value = '';
        inputLifespan.value = '';
    } else {
        document.getElementById('tituloCachorro').innerHTML = `Alterando raça ${id}`;

        var url = `php/cachorro_selecionar.php?id=${id}`;
        var res = await fetch(url).then(resposta => resposta.json());

        inputId.value = res[0].id;
        inputNome.value = res[0].name;
        inputOrigem.value = res[0].origin || '';
        inputTemperamento.value = res[0].temperament || '';
        inputLifespan.value = res[0].lifespan || '';
    }
}

async function salvarCachorro() {
    var inputId = document.getElementById('idCachorro');
    var inputNome = document.getElementById('nomeCachorro');
    var inputOrigem = document.getElementById('origemCachorro');
    var inputTemperamento = document.getElementById('temperamentoCachorro');
    var inputLifespan = document.getElementById('lifespanCachorro');
    var url = '';

    if (inputId.value === '') {
        url = `php/cachorro_inserir.php?name=${inputNome.value}&origin=${inputOrigem.value}&temperament=${inputTemperamento.value}&lifespan=${inputLifespan.value}`;
    } else {
        url = `php/cachorro_alterar.php?id=${inputId.value}&name=${inputNome.value}&origin=${inputOrigem.value}&temperament=${inputTemperamento.value}&lifespan=${inputLifespan.value}`;
    }

    await fetch(url);
    listarCachorros();
}

async function excluirCachorro(id) {
    if (!confirm('Deseja realmente excluir esta raça?')) return;

    var url = `php/cachorro_excluir.php?id=${id}`;
    await fetch(url).then(resposta => { return resposta.json() });
    listarCachorros();
}

async function pesquisarCachorro() {
    var searchQuery = document.getElementById("searchCachorro").value;
    var url = `php/cachorro_buscar.php?name=${searchQuery}`;

    var res = await fetch(url).then(resposta => resposta.json());
    console.log(res);

    var tabela = document.getElementById('tabelaCachorro');
    var a = '';

    if (res.length === 0) {
        a = "<tr><td colspan='6'>Nenhum resultado encontrado</td></tr>";
    } else {
        
        for (var i = 0; i < res.length; i++) {
            a += `<tr>
                    <td>${res[i].id}</td>
                    <td>${res[i].name}</td>
                    <td>${res[i].origin || "Desconhecida"}</td>
                    <td>${res[i].temperament || "Desconhecido"}</td>
                    <td>${res[i].lifespan || "Desconhecido"}</td>
                    <td>
                        <button class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#modalCachorro"
                            onclick="abrirCachorro(${res[i].id})">Alterar</button>
                    </td>
                    <td>
                        <button class="btn btn-danger" onclick="excluirCachorro(${res[i].id})">Excluir</button>
                    </td>
                </tr>`;
        }
    }

    tabela.innerHTML = a;
}


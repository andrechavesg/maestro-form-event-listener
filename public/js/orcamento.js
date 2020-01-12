let tableRowTemplate = `<tr>
                                    <td>#index#</td>
                                    <td>#valorParcela#</td>
                                    <td>#data#</td>
                                </tr>`

let parseTabelaEntrada = function () {
    let tabela = $("#pagamentosEntrada")
    let valorEntrada = $("#app_orcamento_valorEntrada").val()
    let quantidadeDeParcelas = $("#app_orcamento_quantidadeDeParcelasEntrada").val()
    let valorParcela = (valorEntrada / quantidadeDeParcelas).toFixed(2)

    tabela.find("tr").remove()
    for (let index = 1; index <= quantidadeDeParcelas; index++) {
        let data = new Date((new Date()).getTime() + (index - 1) * 2628000000)

        data.setDate((new Date()).getDate())

        tabela.find("tbody").append(tableRowTemplate.replace("#index#", index)
            .replace("#valorParcela#", valorParcela + " R$")
            .replace("#data#", data.getDate() + "/" + (data.getMonth() + 1) + "/" + data.getFullYear())
        )
    }
};
$("#app_orcamento_valorEntrada,#app_orcamento_quantidadeDeParcelasEntrada").on('change', function (e) {
    parseTabelaEntrada();
})

let parseTabelaFinanciamento = function () {
    let tabela = $("#pagamentosFinanciamento")
    let valorEntrada = $("#app_orcamento_valorFinanciamento").val()
    let quantidadeDeParcelas = $("#app_orcamento_quantidadeDeParcelasFinanciamento").val()
    let valorParcela = (valorEntrada / quantidadeDeParcelas).toFixed(2)

    tabela.find("tr").remove()
    for (let index = 1; index <= quantidadeDeParcelas; index++) {
        let data = new Date((new Date()).getTime() + (index - 1) * 2628000000)

        data.setDate((new Date()).getDate())

        tabela.find("tbody").append(tableRowTemplate.replace("#index#", index)
            .replace("#valorParcela#", valorParcela)
            .replace("#data#", data.getDate() + "/" + (data.getMonth() + 1) + "/" + data.getFullYear())
        )
    }
};
$("#app_orcamento_valorFinanciamento,#app_orcamento_quantidadeDeParcelasFinanciamento").on('change', function (e) {
    parseTabelaFinanciamento();
})

$("#app_orcamento_valorEntrada,#app_orcamento_quantidadeDeParcelasEntrada,#app_orcamento_valorFinanciamento,#app_orcamento_quantidadeDeParcelasFinanciamento").on("change", function () {
    let $appOrcamentoValorEntrada = $("#app_orcamento_valorEntrada").val();
    $appOrcamentoValorEntrada = $appOrcamentoValorEntrada.length < 1 ? 0 : $appOrcamentoValorEntrada
    let $appOrcamentoValorFinanciamento = $("#app_orcamento_valorFinanciamento").val();
    $appOrcamentoValorFinanciamento = $appOrcamentoValorFinanciamento.length < 1 ? 0 : $appOrcamentoValorFinanciamento

    let soma = (parseFloat($appOrcamentoValorEntrada) + parseFloat($appOrcamentoValorFinanciamento)).toFixed(2)
    console.log(soma)
    $("#app_orcamento_valorTotal").val(soma)
})

parseTabelaEntrada()
parseTabelaFinanciamento()

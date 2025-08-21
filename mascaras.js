// EXECUTAR MASCARAS
function mascara(o,f){
    //Define o objeto e chama a função
    objeto=o
    funcao=f
    setTimeout("executaMascara()",1)
}

function executaMascara(){
    objeto.value=funcao(objeto.value)
}

//MASCARAS
//TELEFONE
function telefone(variavel){
    variavel=variavel.replace(/\D/g,"")
    variavel=variavel.replace(/^(\d\d)(\d)/g,"($1) $2")//ADICIONA PARENTESES EM VOLTA DOS DOIS PRIMEIROS DIGITOS
    variavel=variavel.replace(/(\d{4})(\d)/,"$1-$2")//ADICIONA HIFEM ENTRE O QUARTO E QUINTO DIGITO
    return variavel
}
//rg/cpf

function nome(variavel){
    variavel=variavel.replace(/\D/,"")
}

function nome(variavel){
    variavel=variavel.replace(/\d/g,"")//REMOVE CARACTERES NÚMERICOS
    return variavel
}
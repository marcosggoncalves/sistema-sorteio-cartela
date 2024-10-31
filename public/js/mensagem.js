const mostrarMensagem = (textos = [], display = 'block', type= 'danger') =>{
    const mensagem = document.getElementById('mensagem');
    
    mensagem.setAttribute('class', `alert alert-${type}`);
    
    mensagem.style.display = display;
    
    mensagem.innerHTML = '';

    textos.forEach(texto =>{
        mensagem.innerHTML += '- ' + texto + '<br>';
    })
}

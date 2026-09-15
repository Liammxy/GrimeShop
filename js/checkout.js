"use strict";
document.addEventListener('DOMContentLoaded', () => {
    const formCheckout = document.querySelector('#modalCheckout form');
    if (formCheckout) {
        formCheckout.addEventListener('submit', async (event) => {
            event.preventDefault(); // Impede o envio padrão do HTML
            const formData = new FormData(formCheckout);
            try {
                // Consumo assíncrono com fetch, async/await e try/catch
                const resposta = await fetch('finalizar_compra.php', {
                    method: 'POST',
                    body: formData
                });
                if (!resposta.ok) {
                    throw new Error(`Erro na requisição: ${resposta.status}`);
                }
                const resultado = await resposta.json();
                if (resultado.sucesso) {
                    alert(resultado.mensagem || 'Pedido finalizado com sucesso!');
                    window.location.href = 'colecoes.php';
                }
                else {
                    alert(resultado.mensagem || 'Erro ao processar o pedido.');
                }
            }
            catch (erro) {
                console.error('Falha no envio assíncrono:', erro);
                alert('Ocorreu um erro ao conectar com o servidor. Tente novamente.');
            }
        });
    }
});

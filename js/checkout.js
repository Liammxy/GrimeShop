"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
document.addEventListener('DOMContentLoaded', () => {
    const formCheckout = document.querySelector('#modalCheckout form');
    if (formCheckout) {
        formCheckout.addEventListener('submit', (event) => __awaiter(void 0, void 0, void 0, function* () {
            event.preventDefault(); // Impede o envio padrão do HTML
            const formData = new FormData(formCheckout);
            try {
                // Consumo assíncrono com fetch, async/await e try/catch
                const resposta = yield fetch('finalizar_compra.php', {
                    method: 'POST',
                    body: formData
                });
                if (!resposta.ok) {
                    throw new Error(`Erro na requisição: ${resposta.status}`);
                }
                const resultado = yield resposta.json();
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
        }));
    }
});

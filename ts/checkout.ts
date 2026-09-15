interface RespostaCheckout {
    sucesso: boolean;
    mensagem?: string;
}

interface ItemCarrinho {
    preco: number;
    quantidade: number;
}

document.addEventListener('DOMContentLoaded', (): void => {
    const formCheckout = document.querySelector('#modalCheckout form') as HTMLFormElement | null;

    if (formCheckout) {
        formCheckout.addEventListener('submit', async (event: Event): Promise<void> => {
            event.preventDefault(); // Impede o envio padrão do HTML

            const formData = new FormData(formCheckout);

            try {
                // Consumo assíncrono com fetch, async/await e try/catch
                const resposta: Response = await fetch('finalizar_compra.php', {
                    method: 'POST',
                    body: formData
                });

                if (!resposta.ok) {
                    throw new Error(`Erro na requisição: ${resposta.status}`);
                }

                const resultado: RespostaCheckout = await resposta.json();

                if (resultado.sucesso) {
                    alert(resultado.mensagem || 'Pedido finalizado com sucesso!');
                    window.location.href = 'colecoes.php';
                } else {
                    alert(resultado.mensagem || 'Erro ao processar o pedido.');
                }

            } catch (erro: unknown) {
                console.error('Falha no envio assíncrono:', erro);
                alert('Ocorreu um erro ao conectar com o servidor. Tente novamente.');
            }
        });
    }
});
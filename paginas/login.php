<?php 
// Como estamos dentro da pasta 'paginas/', voltamos um nível para achar o header e a config
include '../includes/header.php'; 
include('../config/conexao.php');
?>

<main class="position-relative overflow-hidden pb-0 pt-0">

    <!-- Fundo em vídeo e overlay escuro igual à home -->
    <video autoplay muted loop playsinline class="position-absolute top-50 start-50 translate-middle w-100 h-100" style="object-fit: cover; z-index: 1; pointer-events: none;">
        <source src="../images/fundo.mp4" type="video/mp4">
    </video>

    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(18, 18, 18, 0.85); z-index: 2;"></div>

    <div class="container position-relative d-flex justify-content-center align-items-center" style="z-index: 3; min-height: 80vh;">

        <div class="card card-cursed p-5 my-5 w-100" style="max-width: 450px; background-color: #0c0c0c; border: 1px solid #ff0033;" data-aos="fade-down" data-aos-duration="1200">
            
            <div class="text-center mb-4">
                <span class="d-block text-uppercase fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 2px; color: #ff0033;">
                    [ ACESSO RESTRITO ]
                </span>
                <h2 class="text-white fw-bold" style="letter-spacing: 1px; font-size: 1.8rem;">DASHBOARD LOGIN</h2>
            </div>

            <?php if (isset($_GET['erro'])): ?>
                <div class="alert text-center p-2 mb-4" style="background-color: rgba(255, 0, 51, 0.2); color: #ff0033; border: 1px solid #ff0033; font-size: 0.9rem;">
                    E-mail ou senha incorretos!
                </div>
            <?php endif; ?>

            <form action="valida_login.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label text-uppercase small" style="color: #888; letter-spacing: 1px;">E-mail de Acesso</label>
                    <input type="email" id="email" name="email" class="form-control" required placeholder="admin@grime.com" style="background-color: #1a1a1a; border: 1px solid #333; color: #fff; padding: 12px;">
                </div>

                <div class="mb-4">
                    <label for="senha" class="form-label text-uppercase small" style="color: #888; letter-spacing: 1px;">Senha</label>
                    <input type="password" id="senha" name="senha" class="form-control" required placeholder="******" style="background-color: #1a1a1a; border: 1px solid #333; color: #fff; padding: 12px;">
                </div>

                <button type="submit" class="btn btn-cursed text-uppercase w-100 fw-bold py-3" style="background-color: #ff0033; color: #fff; letter-spacing: 1px;">
                    Entrar no Sistema
                </button>
            </form>

        </div>

    </div>
</main>

<style>
.btn-cursed {
    transition: all 0.3s ease-in-out;
}
.btn-cursed:hover {
    background-color: #fff !important;
    color: #0c0c0c !important;
    box-shadow: 0 0 15px #ff0033, 0 0 25px #ff0033;
    border-color: #fff !important;
}
.form-control:focus {
    background-color: #1a1a1a !important;
    color: #fff !important;
    border-color: #ff0033 !important;
    box-shadow: 0 0 10px rgba(255, 0, 51, 0.5);
}
</style>

<?php 
// Puxa o rodapé voltando uma pasta
include '../includes/footer.php'; 
?>
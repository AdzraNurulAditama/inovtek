<style>
    .pantrify-sidebar {
        width: 80px;
        min-width: 80px;
        height: calc(100vh - 2rem); /* Sesuaikan tinggi dengan layar dikurangi padding */
        padding: 1.2rem 0.6rem;
        margin: 1rem 0 1rem 1rem;
        border-radius: 1.25rem;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.04);
        display: flex;
        flex-direction: column;
        align-items: center;
        position: fixed; /* Ubah ke fixed supaya tidak mendorong konten utama ke bawah */
        top: 0;
        left: 0;
        z-index: 100;
    }
    
    /* Tambahkan padding kiri pada body/wrapper utama di layouts.app agar tidak tertutup sidebar fixed */
    .main-content-wrapper {
        margin-left: 105px; /* Lebar sidebar (80px) + margin */
        padding: 1.5rem;
        width: calc(100% - 105px);
    }

    @media(max-width: 991.98px) {
        .pantrify-sidebar {
            width: 100%; height: 70px;
            margin: 0; padding: 0.5rem 1rem;
            border-radius: 0;
            flex-direction: row; justify-content: space-around;
            position: sticky; top: 0; left: auto;
        }
        .main-content-wrapper {
            margin-left: 0;
            width: 100%;
            padding: 1rem;
        }
    }
</style>
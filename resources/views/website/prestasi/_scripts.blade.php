<script>
    function openPrestasiModal(id) {
        const modal = document.getElementById(id);

        if (!modal) {
            return;
        }

        modal.classList.add('show');

        document.body.classList.add(
            'prestasi-modal-open'
        );
    }


    function closePrestasiModal(id) {
        const modal = document.getElementById(id);

        if (!modal) {
            return;
        }

        modal.classList.remove('show');

        document.body.classList.remove(
            'prestasi-modal-open'
        );
    }


    document.addEventListener(
        'keydown',
        function (event) {

            if (event.key !== 'Escape') {
                return;
            }

            const modalAktif = document.querySelector(
                '.prestasi-modal.show'
            );

            if (modalAktif) {
                modalAktif.classList.remove('show');

                document.body.classList.remove(
                    'prestasi-modal-open'
                );
            }
        }
    );


    async function bagikanPrestasi(judul, url) {
        const dataBagikan = {
            title: judul,
            text: 'Prestasi siswa SD Muhammadiyah 16 Karangasem',
            url: url
        };

        try {
            if (navigator.share) {
                await navigator.share(dataBagikan);
                return;
            }

            if (
                navigator.clipboard &&
                window.isSecureContext
            ) {
                await navigator.clipboard.writeText(url);

                alert(
                    'Tautan prestasi berhasil disalin.'
                );

                return;
            }

            const inputSementara =
                document.createElement('textarea');

            inputSementara.value = url;
            inputSementara.style.position = 'fixed';
            inputSementara.style.opacity = '0';

            document.body.appendChild(inputSementara);

            inputSementara.select();

            document.execCommand('copy');

            inputSementara.remove();

            alert(
                'Tautan prestasi berhasil disalin.'
            );

        } catch (error) {
            if (error.name !== 'AbortError') {
                alert(
                    'Prestasi belum berhasil dibagikan.'
                );
            }
        }
    }
</script>
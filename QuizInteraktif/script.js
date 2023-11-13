document.addEventListener("DOMContentLoaded", function () {
    const namaInput = document.getElementById("nama");
    const mulaiButton = document.getElementById("mulai-quiz");
    const quizContainer = document.getElementById("quiz");
    const pertanyaanElement = document.getElementById("pertanyaan");
    const pilihanContainer = document.getElementById("pilihan-container");
    const submitButton = document.getElementById("submit-jawaban");
    const hasilContainer = document.getElementById("hasil-quiz");
    const namaHasil = document.getElementById("nama-hasil");
    const skorHasil = document.getElementById("skor");
    const simpanSkorButton = document.getElementById("simpan-skor");
    const rankingContainer = document.getElementById("ranking");
    const rankingList = document.getElementById("ranking-list");

    let skor = 0;
    let pertanyaanIndex = 0;
    let jawabanBenar = "";

    const pertanyaanAstronomi = [
        {
            pertanyaan: "Berapa banyak planet dalam Tata Surya?",
            pilihan: ["A. 7", "B. 8", "C. 9", "D. 10"],
            jawabanBenar: "B. 8",
        },
        {
            pertanyaan: "Apa nama planet terbesar dalam Tata Surya?",
            pilihan: ["A. Jupiter", "B. Mars", "C. Venus", "D. Saturnus"],
            jawabanBenar: "A. Jupiter",
        },
        {
            pertanyaan: "Apa nama bintang terdekat dengan Bumi?",
            pilihan: ["A. Sirius", "B. Proxima Centauri", "C. Betelgeuse", "D. Alpha Centauri"],
            jawabanBenar: "B. Proxima Centauri",
        },
        {
            pertanyaan: "Berapa lama Bumi membutuhkan untuk mengelilingi Matahari satu kali?",
            pilihan: ["A. 365 hari", "B. 300 hari", "C. 400 hari", "D. 500 hari"],
            jawabanBenar: "A. 365 hari",
        },
        {
            pertanyaan: "Apa yang menyebabkan musim di Bumi?",
            pilihan: ["A. Rotasi Bumi", "B. Perubahan jarak Matahari", "C. Inversi termal", "D. Perubahan sumbu Bumi"],
            jawabanBenar: "D. Perubahan sumbu Bumi",
        },
        {
            pertanyaan: "Apa nama fenomena alam yang disebabkan oleh pembiasan cahaya Matahari di atmosfer?",
            pilihan: ["A. Aurora", "B. Pelangi", "C. Gerhana", "D. El Niño"],
            jawabanBenar: "B. Pelangi",
        },
        {
            pertanyaan: "Bagaimana asal usul tata surya menurut teori yang diterima secara umum?",
            pilihan: ["A. Ledakan Besar", "B. Penciptaan Langsung", "C. Evolusi Kimia", "D. Tabrakan Planetesimal"],
            jawabanBenar: "A. Ledakan Besar",
        },
        {
            pertanyaan: "Apa nama galaksi tempat kita berada?",
            pilihan: ["A. Andromeda", "B. Sombrero", "C. Bima Sakti", "D. Triangulum"],
            jawabanBenar: "C. Bima Sakti",
        },
        {
            pertanyaan: "Apa yang dimaksud dengan lubang hitam?",
            pilihan: ["A. Area gelap di angkasa", "B. Benda dengan massa sangat besar", "C. Galaksi berukuran kecil", "D. Bintang yang sudah mati"],
            jawabanBenar: "B. Benda dengan massa sangat besar",
        },
        {
            pertanyaan: "Apakah Pluto masih dianggap sebagai planet?",
            pilihan: ["A. Ya", "B. Tidak", "C. Bergantung pada definisi planet", "D. Hanya sebagai komet"],
            jawabanBenar: "C. Bergantung pada definisi planet",
        },
    ];

    mulaiButton.addEventListener("click", function () {
        const nama = namaInput.value;
        if (nama) {
            document.getElementById("nama-hasil").textContent = nama;
            mulaiButton.style.display = "none";
            quizContainer.style.display = "block";
            tampilkanPertanyaan();
        } else {
            alert("Silakan masukkan nama Anda.");
        }
    });

    function tampilkanPertanyaan() {
        if (pertanyaanIndex < pertanyaanAstronomi.length) {
            pertanyaanElement.textContent = pertanyaanAstronomi[pertanyaanIndex].pertanyaan;
            pilihanContainer.innerHTML = "";
            jawabanBenar = pertanyaanAstronomi[pertanyaanIndex].jawabanBenar;

            pertanyaanAstronomi[pertanyaanIndex].pilihan.forEach((pilihan, index) => {
                const radioBtn = document.createElement("input");
                radioBtn.type = "radio";
                radioBtn.name = "jawaban";
                radioBtn.value = pilihan;

                const label = document.createElement("label");
                label.textContent = pilihan;
                label.appendChild(radioBtn);

                pilihanContainer.appendChild(label);
            });

            submitButton.style.display = "block";
        } else {
            tampilkanHasil();
        }
    }

    submitButton.addEventListener("click", function () {
        const jawabanTerpilih = document.querySelector('input[name="jawaban"]:checked');

        if (jawabanTerpilih) {
            if (jawabanTerpilih.value === jawabanBenar) {
                skor++;
            }

            pertanyaanIndex++;
            tampilkanPertanyaan();
        } else {
            alert("Silakan pilih jawaban.");
        }
    });

    function tampilkanHasil() {
        quizContainer.style.display = "none";
        hasilContainer.style.display = "block";
        skorHasil.textContent = skor + " dari " + pertanyaanAstronomi.length;
        simpanSkorButton.style.display = "block";
        tampilkanRanking();
    }

    simpanSkorButton.addEventListener("click", function () {
        simpanSkor();
    });

    function simpanSkor() {
        const nama = namaInput.value;
        if (nama) {
            const skorTersimpan = JSON.parse(localStorage.getItem("skorTersimpan")) || [];
            skorTersimpan.push({ nama, skor });
            localStorage.setItem("skorTersimpan", JSON.stringify(skorTersimpan));
            alert("Skor Anda telah disimpan.");
            location.reload(); // Refresh halaman setelah menyimpan skor
        } else {
            alert("Silakan masukkan nama Anda sebelum menyimpan skor.");
        }
    }

    function tampilkanRanking() {
        const skorTersimpan = JSON.parse(localStorage.getItem("skorTersimpan")) || [];
        skorTersimpan.sort((a, b) => b.skor - a.skor);

        if (skorTersimpan.length > 0) {
            rankingList.innerHTML = "";
            rankingContainer.style.display = "block";
            skorTersimpan.forEach((entry, index) => {
                const listItem = document.createElement("li");
                listItem.textContent = `${entry.nama}: ${entry.skor}`;
                rankingList.appendChild(listItem);
            });
        }
    }
});

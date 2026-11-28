
@extends('layouts.app')

@section('title', 'Anggaran Mingguan')

@section('content')
<div class="wb-page">
    <header class="wb-header">
        <div>
            <h1>Anggaran Mingguan</h1>
            <p>Pantau dan kelola pengeluaran belanja dapur setiap minggu.</p>
        </div>
        <button type="button" class="wb-btn wb-primary" id="editBudget">
            Atur Anggaran
        </button>
    </header>

    <section class="wb-card wb-navigation">
        <button type="button" class="wb-btn wb-secondary" id="prevWeek">
            ← Minggu sebelumnya
        </button>
        <div class="wb-period">
            <span>Periode anggaran</span>
            <strong id="weekRange"></strong>
        </div>
        <button type="button" class="wb-btn wb-secondary" id="nextWeek">
            Minggu berikutnya →
        </button>
    </section>

    <section class="wb-card">
        <div class="wb-section-head">
            <div>
                <h2>Ringkasan Minggu Ini</h2>
                <p id="summaryCaption">Ringkasan penggunaan anggaran.</p>
            </div>
            <span class="wb-status" id="status"></span>
        </div>

        <div class="wb-metrics">
            <div class="wb-metric">
                <span>Total anggaran</span>
                <strong id="budget"></strong>
                <small>Batas belanja minggu ini</small>
            </div>
            <div class="wb-metric">
                <span>Sudah terpakai</span>
                <strong id="spent"></strong>
                <small>Total transaksi tercatat</small>
            </div>
            <div class="wb-metric wb-remaining">
                <span>Sisa anggaran</span>
                <strong id="remaining"></strong>
                <small id="remainingHint">Tersedia untuk belanja</small>
            </div>
        </div>

        <div class="wb-usage">
            <div class="wb-line">
                <strong>Penggunaan anggaran</strong>
                <span id="percent"></span>
            </div>
            <div class="wb-progress"><div id="progress"></div></div>
            <div class="wb-line wb-muted">
                <span id="remainingPercent"></span>
                <span id="days"></span>
            </div>
        </div>

        <div class="wb-advice">
            <strong>Rekomendasi belanja harian</strong>
            <p id="dailyLimit"></p>
        </div>
    </section>

    <div class="wb-grid">
        <section class="wb-card">
            <h2>Pengeluaran Harian</h2>
            <p>Perbandingan pengeluaran Senin–Minggu.</p>
            <div id="chart" class="wb-chart"></div>
            <div class="wb-legend">
                <span><i class="wb-swatch"></i> Pengeluaran</span>
                <span><i class="wb-dash"></i> Batas ideal harian</span>
            </div>
        </section>

        <section class="wb-card">
            <h2>Pengeluaran per Kategori</h2>
            <p>Komposisi belanja minggu ini.</p>
            <div id="categories"></div>
        </section>
    </div>

    <div class="wb-grid">
        <section class="wb-card">
            <h2>Indikator Laju</h2>
            <p>Pengeluaran dibandingkan dengan batas ideal.</p>
            <div class="wb-insight" id="pace"></div>
        </section>
        <section class="wb-card">
            <h2>Prediksi Akhir Minggu</h2>
            <p>Perkiraan berdasarkan laju pengeluaran.</p>
            <div class="wb-insight" id="forecast"></div>
        </section>
    </div>

    <section class="wb-card">
        <h2>Perbandingan Minggu Lalu</h2>
        <p id="comparison"></p>
        <div class="wb-rollover">
            <div>
                <h2>Bawa Sisa Anggaran</h2>
                <p id="rolloverText"></p>
            </div>
            <div class="wb-actions">
                <button type="button" class="wb-btn wb-secondary" id="ignore">Abaikan</button>
                <button type="button" class="wb-btn wb-primary" id="carry">Bawa sisa</button>
            </div>
        </div>
    </section>

    <section class="wb-card">
        <h2>Transaksi Minggu Ini</h2>
        <p>Filter transaksi berdasarkan toko atau kategori.</p>
        <div class="wb-filters">
            <input id="search" type="search" placeholder="Cari toko atau kategori...">
            <select id="categoryFilter">
                <option value="">Semua kategori</option>
            </select>
        </div>
        <div class="wb-table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Toko</th>
                        <th>Kategori</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody id="transactions"></tbody>
            </table>
        </div>
    </section>
</div>

<style>
.wb-page {
    --ink: #101a2b;
    --muted: #64748b;
    --border: #e2e8f0;
    max-width: 1500px;
    margin: 0 auto;
    padding: 24px;
    color: var(--ink);
    font-family: Inter, Arial, sans-serif;
}
.wb-page * { box-sizing: border-box; }
.wb-page h1, .wb-page h2, .wb-page p { margin: 0; }
.wb-page h1 { font-size: 28px; font-weight: 750; }
.wb-page h2 { font-size: 18px; font-weight: 700; }
.wb-page p { color: var(--muted); font-size: 14px; line-height: 1.6; }
.wb-header, .wb-section-head, .wb-line, .wb-rollover {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
}
.wb-header { margin-bottom: 22px; }
.wb-header p, .wb-section-head p, .wb-card > p { margin-top: 5px; }
.wb-card {
    background: #fff;
    border: 1px solid var(--border);
    border-radius: 18px;
    padding: 24px;
    margin-bottom: 20px;
}
.wb-navigation {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 14px;
}
.wb-period { text-align: center; }
.wb-period span, .wb-period strong { display: block; }
.wb-period span { color: var(--muted); font-size: 12px; margin-bottom: 5px; }
.wb-btn {
    border: 1px solid var(--border);
    border-radius: 10px;
    padding: 11px 17px;
    font: inherit;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}
.wb-primary { background: var(--ink); color: #fff; border-color: var(--ink); }
.wb-secondary { background: #f8fafc; color: var(--ink); }
.wb-btn:hover { filter: brightness(.96); }
.wb-btn:disabled { opacity: .45; cursor: not-allowed; }
.wb-status {
    border-radius: 20px;
    padding: 7px 12px;
    font-size: 12px;
    font-weight: 650;
    background: #f1f5f9;
    white-space: nowrap;
}
.wb-metrics {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 16px;
    margin: 22px 0;
}
.wb-metric {
    padding: 18px;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: #f8fafc;
}
.wb-metric span, .wb-metric strong, .wb-metric small { display: block; }
.wb-metric span, .wb-metric small { color: var(--muted); font-size: 13px; }
.wb-metric strong { font-size: 24px; margin: 8px 0; }
.wb-remaining { background: #f0fdf4; border-color: #bbf7d0; }
.wb-remaining strong { color: #15803d; }
.wb-line { font-size: 13px; }
.wb-muted { color: var(--muted); margin-top: 8px; }
.wb-progress { height: 11px; background: #e8edf3; border-radius: 20px; overflow: hidden; margin-top: 10px; }
.wb-progress div { height: 100%; border-radius: 20px; transition: width .25s; }
.wb-advice, .wb-insight {
    background: #f1f5f9;
    border: 1px solid var(--border);
    border-radius: 12px;
    padding: 16px;
    margin-top: 16px;
    line-height: 1.6;
}
.wb-advice p { margin-top: 4px; }
.wb-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.wb-chart {
    display: grid;
    grid-template-columns: repeat(7, minmax(0, 1fr));
    gap: 6px;
    height: 210px;
    position: relative;
    margin-top: 20px;
    padding-top: 20px;
}
.wb-bar-col { display: flex; flex-direction: column; justify-content: flex-end; align-items: center; gap: 5px; z-index: 1; }
.wb-bar-col small { font-size: 10px; white-space: nowrap; }
.wb-bar { width: 65%; background: #334155; border-radius: 5px 5px 0 0; }
.wb-ideal { position: absolute; left: 0; right: 0; border-top: 2px dashed #d97706; pointer-events: none; }
.wb-legend { display: flex; gap: 14px; flex-wrap: wrap; color: var(--muted); font-size: 12px; margin-top: 12px; }
.wb-swatch, .wb-dash { display: inline-block; width: 14px; height: 8px; background: #334155; }
.wb-dash { background: #d97706; }
.wb-cat { margin-top: 20px; }
.wb-cat-track { height: 8px; background: #eef2f7; border-radius: 10px; overflow: hidden; margin-top: 7px; }
.wb-cat-fill { height: 100%; background: #0d9488; }
.wb-rollover { border-top: 1px solid var(--border); padding-top: 18px; margin-top: 18px; }
.wb-actions, .wb-filters { display: flex; gap: 10px; }
.wb-filters { margin: 16px 0; flex-wrap: wrap; }
.wb-filters input, .wb-filters select { padding: 11px; border: 1px solid var(--border); border-radius: 9px; font: inherit; font-size: 14px; }
.wb-table-wrap { overflow-x: auto; }
.wb-page table { width: 100%; border-collapse: collapse; text-align: left; }
.wb-page th, .wb-page td { padding: 12px; border-bottom: 1px solid var(--border); white-space: nowrap; }
.wb-page th { color: var(--muted); font-size: 12px; }
@media (max-width: 800px) {
    .wb-page { padding: 12px; }
    .wb-header, .wb-navigation, .wb-section-head, .wb-rollover { flex-wrap: wrap; }
    .wb-period { width: 100%; order: -1; }
    .wb-metrics, .wb-grid { grid-template-columns: 1fr; }
    .wb-card { padding: 18px; }
    .wb-navigation .wb-btn { flex: 1; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const $ = id => document.getElementById(id);
    const money = n => 'Rp' + Math.round(n).toLocaleString('id-ID');
    const names = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const add = (d, n) => {
        const x = new Date(d);
        x.setDate(x.getDate() + n);
        return x;
    };

    const monday = d => add(d, -((d.getDay() + 6) % 7));
    const key = d => [
        d.getFullYear(),
        String(d.getMonth() + 1).padStart(2, '0'),
        String(d.getDate()).padStart(2, '0')
    ].join('-');

    const date = d => d.toLocaleDateString('id-ID', {
        day: 'numeric', month: 'short', year: 'numeric'
    });

    const start = monday(today);
    let offset = 0;
    const storageKey = 'pantrifyWeeklyBudgetV2';

    let store = {
        budgets: {},
        decisions: {},
        transactions: []
    };

    try {
        const saved = JSON.parse(localStorage.getItem(storageKey) || 'null');
        if (saved) store = saved;
    } catch (e) {}

    // Data contoh Rp325.000 untuk minggu berjalan.
    if (!store.seeded) {
        const sample = [
            ['Pasar Sayur', 'Sayuran', 75000],
            ['Toko Sembako', 'Sembako', 90000],
            ['Pasar Buah', 'Buah', 50000],
            ['Minimarket', 'Sembako', 65000],
            ['Toko Sayur', 'Sayuran', 45000]
        ];

        sample.forEach((t, i) => {
            if (i <= (today.getDay() + 6) % 7) {
                store.transactions.push({
                    date: key(add(start, i)),
                    shop: t[0],
                    category: t[1],
                    amount: t[2]
                });
            }
        });

        store.seeded = true;
        save();
    }

    function save() {
        localStorage.setItem(storageKey, JSON.stringify(store));
    }

    const current = () => add(start, offset * 7);
    const base = d => Number(store.budgets[key(d)] ?? 500000);
    const records = d => store.transactions.filter(t =>
        t.date >= key(d) && t.date <= key(add(d, 6))
    );
    const sum = rows => rows.reduce((s, t) => s + Number(t.amount), 0);

    let selectedRows = [];

    function render() {
        const d = current();
        const end = add(d, 6);
        const rows = records(d);
        const budget = base(d);
        const spent = sum(rows);
        const remain = budget - spent;
        const pct = budget > 0 ? spent / budget * 100 : 0;
        const elapsed = offset < 0 ? 7 : offset > 0 ? 0 :
            ((today.getDay() + 6) % 7) + 1;
        const left = offset < 0 ? 0 : offset > 0 ? 7 : 7 - elapsed;
        const ideal = budget * elapsed / 7;
        const forecast = elapsed ? spent / elapsed * 7 : 0;
        const previous = sum(records(add(d, -7)));

        $('weekRange').textContent = date(d) + ' – ' + date(end);
        $('summaryCaption').textContent = offset === 0
            ? 'Ringkasan pengeluaran minggu berjalan.'
            : 'Ringkasan pengeluaran periode yang dipilih.';

        $('budget').textContent = money(budget);
        $('spent').textContent = money(spent);
        $('remaining').textContent = money(remain);
        $('remainingHint').textContent = remain < 0
            ? 'Melebihi batas anggaran'
            : 'Tersedia untuk belanja';

        $('percent').textContent = pct.toFixed(1).replace('.', ',') + '% terpakai';
        $('remainingPercent').textContent =
            'Sisa ' + Math.max(0, 100 - pct).toFixed(1).replace('.', ',') + '%';
        $('days').textContent = left + ' hari tersisa setelah hari ini';

        const color = pct >= 100 ? '#dc2626' : pct >= 80 ? '#ea580c' :
            pct >= 60 ? '#ca8a04' : '#16a34a';

        $('progress').style.width = Math.min(100, Math.max(0, pct)) + '%';
        $('progress').style.background = color;
        $('status').textContent = pct >= 100 ? 'Melebihi anggaran' :
            pct >= 80 ? 'Hampir habis' : pct >= 60 ? 'Perlu diperhatikan' : 'Aman';

        $('status').style.color = color;
        $('remaining').style.color = remain < 0 ? '#dc2626' : '#15803d';

        if (offset < 0) {
            $('dailyLimit').textContent = 'Periode minggu ini telah berakhir.';
        } else {
            const daysForLimit = offset === 0 ? left + 1 : 7;
            $('dailyLimit').textContent =
                'Sisa ' + money(Math.max(0, remain)) + ' untuk ' + daysForLimit +
                ' hari termasuk hari ini. Batas belanja sekitar ' +
                money(Math.max(0, remain) / daysForLimit) + ' per hari.';
        }

        $('pace').textContent = elapsed
            ? 'Hari ke-' + elapsed + ': ideal ' + money(ideal) +
              ', terpakai ' + money(spent) + '. ' +
              (spent <= ideal ? 'Masih sesuai laju.' : 'Pengeluaran di atas laju ideal.')
            : 'Minggu belum dimulai.';

        $('forecast').textContent = elapsed
            ? 'Dengan laju sekarang, total minggu ini sekitar ' + money(forecast) +
              '. ' + (forecast > budget ? 'Berpotensi melewati anggaran.' : 'Masih dalam batas anggaran.')
            : 'Belum ada laju pengeluaran.';

        $('comparison').textContent = previous
            ? (spent >= previous ? 'Naik ' : 'Turun ') +
              Math.abs((spent - previous) / previous * 100).toFixed(1) +
              '% dibanding minggu lalu.'
            : 'Belum ada transaksi minggu lalu.';

        const decision = store.decisions[key(d)];
        $('rolloverText').textContent = decision
            ? 'Pilihan tersimpan: ' + decision
            : 'Sisa ' + money(Math.max(0, remain)) + ' dapat dibawa ke minggu depan.';

        $('carry').disabled = !!decision || remain <= 0;
        $('ignore').disabled = !!decision;

        const daily = names.map((_, i) =>
            sum(rows.filter(t => t.date === key(add(d, i))))
        );
        const max = Math.max(budget / 7, ...daily, 1) * 1.15;
        const chartHeight = 145;

        $('chart').replaceChildren();
        const line = document.createElement('div');
        line.className = 'wb-ideal';
        line.style.bottom = (20 + (budget / 7) / max * chartHeight) + 'px';
        $('chart').appendChild(line);

        daily.forEach((v, i) => {
            const col = document.createElement('div');
            col.className = 'wb-bar-col';
            const amount = document.createElement('small');
            amount.textContent = v ? money(v) : '0';
            const bar = document.createElement('div');
            bar.className = 'wb-bar';
            bar.style.height = (v / max * chartHeight) + 'px';
            const label = document.createElement('small');
            label.textContent = names[i];
            col.append(amount, bar, label);
            $('chart').appendChild(col);
        });

        const cats = {};
        rows.forEach(t => {
            cats[t.category] = (cats[t.category] || 0) + Number(t.amount);
        });

        $('categories').replaceChildren();
        Object.entries(cats).forEach(([category, value]) => {
            const row = document.createElement('div');
            row.className = 'wb-cat';
            const label = document.createElement('div');
            label.className = 'wb-line';
            const name = document.createElement('span');
            name.textContent = category;
            const amount = document.createElement('strong');
            amount.textContent = money(value);
            label.append(name, amount);
            const track = document.createElement('div');
            track.className = 'wb-cat-track';
            const fill = document.createElement('div');
            fill.className = 'wb-cat-fill';
            fill.style.width = (spent ? value / spent * 100 : 0) + '%';
            track.appendChild(fill);
            row.append(label, track);
            $('categories').appendChild(row);
        });

        if (!rows.length) $('categories').textContent = 'Belum ada transaksi.';

        const oldCategory = $('categoryFilter').value;
        $('categoryFilter').replaceChildren(new Option('Semua kategori', ''));
        Object.keys(cats).forEach(c => $('categoryFilter').add(new Option(c, c)));
        $('categoryFilter').value = cats[oldCategory] ? oldCategory : '';

        selectedRows = rows;
        drawTable();
    }

    function drawTable() {
        const q = $('search').value.toLowerCase();
        const c = $('categoryFilter').value;
        const rows = selectedRows.filter(t =>
            (t.shop + ' ' + t.category).toLowerCase().includes(q) &&
            (!c || t.category === c)
        );

        $('transactions').replaceChildren();

        if (!rows.length) {
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            td.colSpan = 4;
            td.textContent = 'Tidak ada transaksi.';
            tr.appendChild(td);
            $('transactions').appendChild(tr);
            return;
        }

        rows.forEach(t => {
            const tr = document.createElement('tr');
            [t.date, t.shop, t.category, money(t.amount)].forEach(value => {
                const td = document.createElement('td');
                td.textContent = value;
                tr.appendChild(td);
            });
            $('transactions').appendChild(tr);
        });
    }

    $('prevWeek').onclick = () => { offset--; render(); };
    $('nextWeek').onclick = () => { offset++; render(); };
    $('search').oninput = drawTable;
    $('categoryFilter').onchange = drawTable;

    $('editBudget').onclick = () => {
        const value = prompt('Masukkan anggaran minggu ini:', base(current()));
        if (value === null) return;
        const n = Number(value.replace(/\D/g, ''));
        if (n > 0) {
            store.budgets[key(current())] = n;
            save();
            render();
        }
    };

    $('carry').onclick = () => {
        const d = current();
        const next = add(d, 7);
        const remaining = Math.max(0, base(d) - sum(records(d)));
        store.budgets[key(next)] = base(next) + remaining;
        store.decisions[key(d)] = 'Bawa sisa';
        save();
        render();
    };

    $('ignore').onclick = () => {
        store.decisions[key(current())] = 'Abaikan';
        save();
        render();
    };

    render();
});
</script>
@endsection

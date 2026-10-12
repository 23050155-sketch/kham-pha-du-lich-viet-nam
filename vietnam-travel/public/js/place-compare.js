
(function () {
    'use strict';

    const IDS_KEY = 'tpdd_compare_places';
    const NAMES_KEY = 'tpdd_compare_names';
    const MAX_PLACES = 3;

    function getIds() {
        try {
            const raw = JSON.parse(
                localStorage.getItem(IDS_KEY) || '[]'
            );

            if (!Array.isArray(raw)) return [];

            return [...new Set(
                raw.map(Number).filter(
                    id => Number.isInteger(id) && id > 0
                )
            )].slice(0, MAX_PLACES);
        } catch {
            return [];
        }
    }

    function getNames() {
        try {
            const raw = JSON.parse(
                localStorage.getItem(NAMES_KEY) || '{}'
            );

            return raw && typeof raw === 'object'
                && !Array.isArray(raw)
                ? raw
                : {};
        } catch {
            return {};
        }
    }

    function save(ids, names) {
        localStorage.setItem(
            IDS_KEY,
            JSON.stringify(ids)
        );

        localStorage.setItem(
            NAMES_KEY,
            JSON.stringify(names)
        );
    }

    function refreshButtons() {
        const ids = getIds();

        document.querySelectorAll('.compare-add-btn')
            .forEach(button => {
                const id = Number(button.dataset.placeId);
                const selected = ids.includes(id);

                button.classList.toggle(
                    'is-selected',
                    selected
                );

                button.textContent = selected
                    ? '✓ Đã chọn'
                    : '+ So sánh';

                button.setAttribute(
                    'aria-pressed',
                    String(selected)
                );
            });
    }

    function refreshBar() {
        const bar = document.getElementById(
            'compare-floating-bar'
        );
        const list = document.getElementById(
            'compare-selected-list'
        );
        const count = document.getElementById(
            'compare-count'
        );
        const nowButton = document.getElementById(
            'compare-now-btn'
        );

        if (!bar || !list || !count || !nowButton) {
            return;
        }

        const ids = getIds();
        const names = getNames();

        bar.hidden = ids.length === 0;
        count.textContent = ids.length + '/3 địa điểm';
        nowButton.disabled = ids.length < 2;

        list.replaceChildren();

        ids.forEach(id => {
            const item = document.createElement('div');
            item.className = 'compare-selected-item';

            const label = document.createElement('span');
            label.textContent =
                names[id] || 'Địa điểm #' + id;

            const remove = document.createElement('button');
            remove.type = 'button';
            remove.textContent = '×';
            remove.setAttribute(
                'aria-label',
                'Bỏ ' + label.textContent
            );

            remove.addEventListener('click', () => {
                togglePlace(id);
            });

            item.append(label, remove);
            list.appendChild(item);
        });
    }

    function refresh() {
        refreshButtons();
        refreshBar();
    }

    function togglePlace(id, name = '') {
        if (!Number.isInteger(id) || id <= 0) return;

        let ids = getIds();
        const names = getNames();

        if (ids.includes(id)) {
            ids = ids.filter(item => item !== id);
            delete names[id];
        } else {
            if (ids.length >= MAX_PLACES) {
                alert('Bạn chỉ được chọn tối đa 3 địa điểm.');
                return;
            }

            ids.push(id);
            names[id] = name || 'Địa điểm #' + id;
        }

        save(ids, names);
        refresh();
    }

    function goToCompare() {
        const ids = getIds();

        if (ids.length < 2) {
            alert('Vui lòng chọn ít nhất 2 địa điểm.');
            return;
        }

        const params = new URLSearchParams();

        ids.forEach(id => {
            params.append('places[]', id);
        });

        const url = window.TPDD_COMPARE_URL || '/compare';

        window.location.href =
            url + '?' + params.toString();
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Dùng event delegation để hỗ trợ cả card
        // được thêm động sau khi trang tải.
        document.addEventListener('click', event => {
            const button = event.target.closest(
                '.compare-add-btn'
            );

            if (!button) return;

            event.preventDefault();
            event.stopPropagation();

            togglePlace(
                Number(button.dataset.placeId),
                button.dataset.placeName || ''
            );
        });

        document.getElementById('compare-now-btn')
            ?.addEventListener('click', goToCompare);

        document.getElementById('compare-clear-btn')
            ?.addEventListener('click', () => {
                save([], {});
                refresh();
            });

        refresh();
    });

    window.addEventListener('storage', event => {
        if (
            event.key === IDS_KEY ||
            event.key === NAMES_KEY
        ) {
            refresh();
        }
    });
})();

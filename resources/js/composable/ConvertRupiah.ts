export function formatNumber() {
    const useRupiah = (value: number) => {
        if (value === null || value === undefined) {
            return 'Rp 0.00';
        }

        const formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0,
        }).format(value);

        return formatted.replace(/\./g, ',');
    };

    const useNumber = (value: number) => {
        if (value === null || value === undefined) {
            return '0,00';
        }

        return new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        }).format(value);
    };

    return { useRupiah, useNumber };
}

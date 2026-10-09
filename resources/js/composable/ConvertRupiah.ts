export function formatNumber() {
    const useRupiah = (value: number) => {
        if (value === null || value === undefined || value == 0) {
            return 'Rp ,-';
        }

        const formatted = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            maximumFractionDigits: 0,
        }).format(value);

        return formatted.replace(/\./g, ',');
    };

    const useNumber = (value: number | null | undefined) => {
        if (value === null || value === undefined) {
            return '0,00';
        }

        return new Intl.NumberFormat('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        }).format(value);
    };

    const formatDate = (dateString: string) => {
        return new Date(dateString).toLocaleDateString('id-ID', {
            day: '2-digit',
            month: 'short',
            year: 'numeric',
        });
    };

    return { useRupiah, useNumber, formatDate };
}

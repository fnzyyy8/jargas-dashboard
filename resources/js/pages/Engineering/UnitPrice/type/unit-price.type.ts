export interface UnitPriceType {
    id: number;
    name: string;
    number: string;
}

interface itemDetail {
    id: number;
    name: string;
    unit: string;
    sort_order: number;
}

interface Category {
    id: number;
    name: string;
    sort_order: number;
    item_details?: itemDetail[];
    sub_categories?: SubCategory[];
}

interface SubCategory {
    id: number;
    name: string;
    sort_order: number;
    item_details?: itemDetail[];
}
export interface Section {
    id: number;
    name: string;
    sort_order: number;
    item_details?: itemDetail[];
    categories?: Category[];
}

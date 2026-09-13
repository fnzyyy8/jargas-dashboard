interface ItemDetail {
    id: number;
    section_id: number;
    category_id?: number | null;
    sub_category_id?: number | null;
    name: string;
    unit: string;
    sort_order: number;
}

interface SubCategory {
    id: number;
    name: string;
    sort_order: number;
    item_details?: ItemDetail[];
}
interface Category {
    id: number;
    name: string;
    sort_order: number;
    item_details?: ItemDetail[];
    sub_categories?: SubCategory[];
}

export interface Section {
    id: number;
    name: string;
    sort_order: number;
    item_details?: ItemDetail[];
    categories?: Category[];
}

export interface UnitPrice {
    id: number;
    name: string;
    item_detail_id: number;
    isFreeIssueMaterial: boolean;
    item_detail?: ItemDetail;
}

export interface PriceList {
    id: number;
    name: string;
    number: string;
}

export interface UnitPricePageProps {
    priceList: PriceList;
    unitPrices: UnitPrice[];
    items: Section[];
}

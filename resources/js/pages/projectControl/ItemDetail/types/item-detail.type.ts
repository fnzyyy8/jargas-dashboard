export interface SectionOption {
    id: number;
    name: string;
    sort_order: number;
}

export interface CategoryOption {
    id: number;
    section_id: number;
    name: string;
    sort_order: number;
}

export interface SubCategoryOption {
    id: number;
    category_id: number;
    name: string;
    sort_order: number;
}

export interface ItemDetailOptions {
    sections: SectionOption[];
    categories: CategoryOption[];
    subCategories: SubCategoryOption[];
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

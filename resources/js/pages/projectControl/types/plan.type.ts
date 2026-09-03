export interface Project {
    id: number;
    project_number: string;
    project_name: string;
    area: string;
    client: string;
}

export interface Boq {
    id: number;
    detailed_area: string;
    isMultipleCustomer: boolean;
    project: Project;
}

export interface Plan {
    id: number;
    section: string;
    category: string;
    sub_category: string;
    item_detail: string;
    unit: string;
    volume: number;
    unit_price: number;
}

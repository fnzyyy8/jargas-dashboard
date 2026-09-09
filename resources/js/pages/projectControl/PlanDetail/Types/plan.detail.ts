export interface Plans {
    id: number;
    boq_id: number;
    customer_category: string;
    section: string;
    category: string | null;
    sub_category: string | null;
    item_detail: string;
    unit: string;
    unit_price: number;
    volume: number;
    boq?: Boq;
}
interface Boq {
    id: number;
    project_id: number;
    detailed_area: string;
    project?: Project;
}

interface Project {
    id: number;
    project_name: string;
    project_number: string;
    area: string;
    client: string;
    start_date: string;
    end_date: string;
}

export interface PlanDetail {
    id: number;
    plan_date: string;
    plan_volume: number;
}

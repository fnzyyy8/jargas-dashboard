export interface Boq {
    id: number;
    project_number: string;
    project_area: string;
    project_name: string;
    detailed_area: string;
}

export interface Project {
    id: number;
    project_name: string;
    category: string;
}

export interface BoqPageProps {
    boqs: Boq[];
    categories: string[];
    projects: Project[];
}

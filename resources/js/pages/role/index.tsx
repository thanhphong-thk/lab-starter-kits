import RoleDataTable from "@/components/frontend/RoleDataTable";
import AppLayout from "@/layouts/app-layout";
import { PageProps } from "@/types";
import { Role } from "@/types/role";

type RoleProps = PageProps<{
    roles: Role[];
}>
export default function Roles ({ roles }: RoleProps) {
    return (
        <AppLayout>
            <div className="p-4">
                <RoleDataTable roles={roles}/>
            </div>
        </AppLayout>
    );
}

import adminRoutes from './admin/adminRoutes'
import clientRoutes from './client/clientRoutes'

const routes = [...adminRoutes, ...clientRoutes]

export default routes

```
api.add_resource(AgentInfo.AgentAPI, '/todo/api/v1.0/agent', endpoint='agent')
api.add_resource(GroupsList.GroupsAPI, '/todo/api/v1.0/groups', endpoint='groups')
api.add_resource(GroupsList.GroupAPI, '/todo/api/v1.0/group/<int:id>', endpoint='group')
api.add_resource(GroupsList.GroupVarsAPI, '/todo/api/v1.0/group/<int:id>/vars',
                 endpoint='groupvars')
api.add_resource(HostsList.HostsAPI, '/todo/api/v1.0/hosts', endpoint='hosts')
api.add_resource(HostsList.HostAPI, '/todo/api/v1.0/host/<int:id>', endpoint='host')
api.add_resource(HostsList.HostVarsAPI, '/todo/api/v1.0/host/<int:id>/vars',
                 endpoint='hostvars')
api.add_resource(Tasks.TasksAPI, '/todo/api/v1.0/tasks', endpoint='tasks')
api.add_resource(Tasks.TaskAPI, '/todo/api/v1.0/task/<int:id>', endpoint='task')
api.add_resource(Tasks.TaskRunAPI, '/todo/api/v1.0/task/<int:id>/run',
                 endpoint='taskrun')
```

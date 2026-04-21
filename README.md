<div>
  <h1>Project API Tasks</h1>
  <h5>This project was been created for management your tasks</h5>
</div>
<div>
  <h1>Main features:</h1>
  <ul>
    <li>Validation routes with JWT</li>
    <li>Create tasks and users</li>
    <li>Refresh token</li>
  </ul>
</div>
<div>
  <h1>Endpoints</h1>
  <h3>POST</h3>
  <ul>
    <li>/signup - Create an user</li>
    <li>/signin - Login user</li>
    <li>/tasks - Create a task</li>
  </ul>
  <h3>GET</h3>
  <ul>
    <li>/tasks - Showing all your tasks</li>
  </ul>
  <h3>PUT</h3>
  <ul>
    <li>/tasks/:id - Update a task</li>
  </ul>
  <h3>DELETE</h3>
  <ul>
    <li>/tasks/:id - Delete a task</li>
  </ul>
</div>
<div>
  <h1>Types</h1>
  <div>
    <h3>Task</h3>
    <p>
      {
        "description": string,
        "date": string | Date,
        "is_done": "done" | "pending",
        "user_id": number
      }
    </p>
  </div>
  <div>
    <h3>User</h3>
    <p>
      {
        "full_name": string,
        "email": string,
        "password": string,
      }
    </p>
  </div>
</div>

export default {
  activeProjectId: "",
  activeProjectName: "project",

  setActiveProject(id, name) {
    this.activeProjectId = id;
    this.activeProjectName = name
  }
}

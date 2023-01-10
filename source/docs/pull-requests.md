---
title: Pull Requests
description: Guide to creating, maintaining, and completing GitHub pull requests.
extends: _layouts.documentation
section: content
---
1. Log into ZenHub and determine the issue you will be working on from the **Sprint Backlog** pipeline.
2. Move this issue over to the **In Progress** pipeline.
3. Open your project in VSCode.
4. Make sure you are on your local develop branch, and that you are up-to-date with `origin/develop`.
5. Create a new branch from develop and name it according to what it addresses, in `kebab-case`.
6. Update `CHANGELOG.md` with a description of what you will be working on, under one of the appropriate sections under the `Unreleased` section, worded in such a way that the subsection will form a complete sentence when read with each list item:

  ```md
  ### 🎉 Added
  - awesome things to the dashboard.
  ```

7. Save the changelog entries.
8. Open the Source Control tab, and commit your changelog changes.
9. Click the **Publish Branch** button.
10. VSCode will now ask you if you want to create a pull request. Click the **Create Pull Request…** button.
11. Change the title of the PR to read similar to what your changelog entry is, except that instead of past-tense, use present tense: &quot;Add awesome things to the dashboard.&quot; (The PR title should be phrased as a request to be completed.)
12. Select the correct branch you based your PR on.
13. Under related issues, add the issue number you are working on, for example:

  ```md
  ## Related Issues
  #1234
  ```

14. Make sure the &quot;Create as draft&quot; checkbox is marked.
15. Click the **Create** button.
16. Perform the work necessary to satisfy the issue.
17. Commit any changes at a minimum each day before stopping work.
18. Update the changelog to account for any differences in implementation from your original changelog entry.
19. When done implementing your changes, commit them.
20. Open the GitHub tab and select the PR you are working on, and click on the Description entry.
21. Scroll all the way to the bottom and click the **Ready for review** button.
